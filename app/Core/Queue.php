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
     * Fetch the next available pending job (transaction safe)
     *
     * @return JobModel|null
     */
    public function fetchNext(): ?JobModel
    {
        $job = JobModel::where('status', 'pending')
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
}
