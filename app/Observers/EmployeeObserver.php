<?php

namespace App\Observers;

use App\Models\Employee;
use Exception;
use App\Services\Shortener;

class EmployeeObserver
{
    protected function updateShortLink(Employee $employee)
    {
        try {
            if(empty($employee->short_url)) {
                $shortener = app(Shortener::class);
                $short_url = $shortener->short($employee);
                if(!empty($short_url)) {
                    $employee->update(['short_url' => $short_url]);
                }
            }
        } catch (Exception $e) {
        }
    }
    /**
     * Handle the employee "created" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function created(Employee $employee)
    {
        $this->updateShortLink($employee);
    }

    /**
     * Handle the employee "updated" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function updated(Employee $employee)
    {
        $this->updateShortLink($employee);
    }

    /**
     * Handle the employee "deleted" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function deleted(Employee $employee)
    {
        //
    }

    /**
     * Handle the employee "restored" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function restored(Employee $employee)
    {
        //
    }

    /**
     * Handle the employee "force deleted" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function forceDeleted(Employee $employee)
    {
        //
    }
}
