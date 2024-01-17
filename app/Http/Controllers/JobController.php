<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Jobs\GenerateRandomArray;
use App\Models\JobStatus;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function store(JobRequest $request)
    {
        $validated = $request->validated();
        $x = $validated["x"];
        
        // Save Job with Pending status
        $jobStatus = JobStatus::create([
            "status" => JobStatus::STATUS_PENDING,
        ]);

        // Dispatch job
        GenerateRandomArray::dispatch($x, $jobStatus->id);

        return response()->json([
            "message" => "Task has been added to the queue",
            "jobId" => $jobStatus->id,
        ]);
    }

    public function checkJobStatus($jobId)
    {
        $jobStatus = JobStatus::find($jobId);

        if (!$jobStatus) {
            return response()->json(["message" => "Job status not found"], 404);
        }

        if ($jobStatus->status !== JobStatus::STATUS_DONE) {
            return response()->json([
                "status" => $jobStatus->status,
            ]);
        } else {
            return response()->json([
                "result" => json_decode($jobStatus->result),
            ]);
        }
    }
}
