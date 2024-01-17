<?php

namespace App\Jobs;

use App\Models\JobStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateRandomArray implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $x;
    protected $statusId;

    /**
     * Create a new job instance.
     */
    public function __construct($x, $statusId)
    {
        $this->x = $x;
        $this->statusId = $statusId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Update the status to 'In Progress' at the start
        $this->updateStatus(JobStatus::STATUS_IN_PROGRESS);

        // Simulate job execution, at least 15 seconds.
        sleep(15);

        $res = [];

        // Generate random array with unique values.
        while (count($res) < $this->x) {
            $randomNumber = rand(1, getrandmax());
            if (!in_array($randomNumber, $res)) {
                $res[] = $randomNumber;
            }
        }

        // Update the status to 'Done' when finished
        $this->updateStatus(JobStatus::STATUS_DONE, $res);
    }

    protected function updateStatus($status, $result = null)
    {
        $jobStatus = JobStatus::find($this->statusId);
        if ($jobStatus) {
            $updateData = ['status' => $status];
            if ($result !== null) {
                $updateData['result'] = json_encode($result);
            }
            $jobStatus->update($updateData);
        }
    }
}
