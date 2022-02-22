<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeJobController extends Controller
{
    public function store(Employee $employee, Request $request)
    {
        return $employee->jobs()->attach($request->jobId);
    }
}
