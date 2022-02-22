<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function store(JobRequest $job)
    {
        return Job::create($job->validated());
    }
}
