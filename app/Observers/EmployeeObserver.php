<?php

namespace App\Observers;

use App\Models\Employee;
use App\Models\User;

class EmployeeObserver
{
    /**
     * Handle the Employee "creating" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function creating(Employee $employee)
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
    }

    /**
     * Handle the Employee "updated" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function updated(Employee $employee)
    {
        User::whereId($employee->user_id)->update([
            'name'      => $employee->name,
            'surname'   => $employee->surname,
        ]);
    }

    /**
     * Handle the Employee "updated" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function saving(Employee $employee)
    {
        //
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
