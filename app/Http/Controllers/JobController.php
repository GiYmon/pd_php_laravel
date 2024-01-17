<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Jobs\GenerateRandomArray;
use App\Models\JobStatus;
use Illuminate\Support\Facades\Log;
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
}
