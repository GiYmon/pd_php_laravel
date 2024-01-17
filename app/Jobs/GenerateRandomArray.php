<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateRandomArray implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $x;

    /**
     * Create a new job instance.
     */
    public function __construct($x)
    {
        $this->x = $x;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
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

        Log::info($res);
    }
}
