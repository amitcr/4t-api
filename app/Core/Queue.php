<?php
namespace App\Core;

use App\Models\JobModel;
use Carbon\Carbon;
use Exception;

class Queue
{
    /**
     * Dispatch a new job to the queue
     *
     * @param string $jobClass Fully qualified class name of the job
     * @param array  $data Payload data to pass to the job
     */
    public function dispatch(string $jobClass, array $data = []): JobModel
    {
        // Ensure payload is valid JSON
        $payload = json_encode($data);

        return JobModel::create([
            'job_class' => $jobClass,
            'payload'   => $payload ?: '{}',
            'status'    => 'pending',
            'created_at'=> Carbon::now(),
        ]);
    }

    /**
     * Fetch the next runnable job (transaction safe).
     *
     * Picks pending jobs, plus held jobs whose hold window has elapsed. A job is only
     * runnable once `available_at` is due (NULL or in the past) so held jobs wait out
     * their retry window instead of being re-run immediately.
     *
     * @return JobModel|null
     */
    public function fetchNext(): ?JobModel
    {
        $now = Carbon::now();

        $job = JobModel::whereIn('status', ['pending', 'held'])
            ->where(function ($q) use ($now) {
                $q->whereNull('available_at')
                  ->orWhere('available_at', '<=', $now);
            })
            ->orderBy('id', 'ASC')
            ->lockForUpdate()
            ->first();

        if ($job) {
            $job->increment('attempts');
            return $job;
        }

        return null;
    }

    /**
     * Mark a job as completed
     */
    public function markCompleted(JobModel $job): void
    {
        $job->update([
            'status'       => 'completed',
            'completed_at' => Carbon::now(),
        ]);
    }

    /**
     * Mark a job as failed
     */
    public function markFailed(JobModel $job): void
    {
        $job->update([
            'status'     => 'failed',
            'failed_at'  => Carbon::now(),
        ]);
    }

    /**
     * Hold a job for a configurable window, then let it retry automatically.
     *
     * Used when a report job can't complete yet because chart images are missing.
     * The job is released early (available_at set to now) when the admin generates
     * the chart manually — see mytemp_release_held_report_jobs() on the WP side.
     */
    public function markHeld(JobModel $job): void
    {
        $hours = (int) Config::get('app.report_hold_hours');
        if ($hours <= 0) {
            $hours = 6;
        }

        $job->update([
            'status'       => 'held',
            'available_at' => Carbon::now()->addHours($hours),
            'reserved_at'  => null,
        ]);
    }
}
