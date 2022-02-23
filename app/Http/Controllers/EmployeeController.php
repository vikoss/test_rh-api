<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    public function store(EmployeeRequest $employee)
    {
        return Employee::create($employee->validated());
    }

    public function update(Employee $employee, Request $request)
    {
        return $employee->update($request->all());
    }
}
