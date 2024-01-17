<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    use HasFactory;

    protected $table = "job_statuses";

    const STATUS_PENDING = "Pending";
    const STATUS_IN_PROGRESS = "In Progress";
    const STATUS_DONE = "Done";

    protected $fillable = ["status", "result"];
}
