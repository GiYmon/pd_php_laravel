<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Jobs\GenerateRandomArray;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function store(JobRequest $request)
    {
        $validated = $request->validated();
        $x = $validated["x"];

        GenerateRandomArray::dispatch($x);


        return response()->json([
            "message" => "Received value x.",
            "x" => $x,
        ]);
    }
}
