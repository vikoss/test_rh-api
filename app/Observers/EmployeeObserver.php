<?php

namespace App\Observers;

use App\Models\Employee;
use App\Models\User;

class EmployeeObserver
{
    /**
     * Handle the Employee "created" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function created(Employee $employee)
    {
        //
    }

    /**
     * Handle the Employee "updated" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function updated(Employee $employee)
    {
        //
    }

    /**
     * Handle the Employee "updated" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function saving(Employee $employee)
    {
        $end = 1;
        $surname = substr($employee->surname, 0, $end);
        $email = "{$employee->name}{$surname}@rh.com";
        while (User::select('id')->whereEmail($email)->first()) {
            $end++;
            $surname = substr($employee->surname, 0, $end);
            $email = "{$employee->name}{$surname}@rh.com";
        }
        $user = User::create([
            'name'      => $employee->name,
            'surname'   => $employee->surname,
            'email'     => $email,
            'password'  => $employee->dni,
        ]);
        $employee->user_id = $user->id;
        //dd($employee);
    }

    /**
     * Handle the Employee "deleted" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function deleted(Employee $employee)
    {
        //
    }

    /**
     * Handle the Employee "restored" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function restored(Employee $employee)
    {
        //
    }

    /**
     * Handle the Employee "force deleted" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function forceDeleted(Employee $employee)
    {
        //
    }
}
