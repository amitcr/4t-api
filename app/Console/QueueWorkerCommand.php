<?php
namespace App\Console;

use App\Core\CommandInterface;
use App\Core\Queue;

class QueueWorkerCommand implements CommandInterface
{
    public $signature = 'queue:work';
    public $description = 'Process jobs from the queue instantly';

    public function handle($arguments)
    {
        $queue = new Queue();

        // Infinite loop for background processing
        while (true) {
            $job = $queue->fetchNext();

            if ($job) {
                // $job is a JobModel instance
                $payload = json_decode($job->payload, true);
                $jobClass = $job->job_class;

                try {
                    // Execute the job
                    (new $jobClass())->handle($payload);

                    // Mark job as completed
                    $queue->markCompleted($job);
                    echo "Job {$job->id} completed.\n";
                } catch (\Throwable $e) {
                    // Mark job as failed
                    $queue->markFailed($job);
                    echo "Job {$job->id} failed: {$e->getMessage()}\n";
                }
            } else {
                // No job found, wait 0.5 second before polling again
                usleep(500000);
            }
        }
    }
}
