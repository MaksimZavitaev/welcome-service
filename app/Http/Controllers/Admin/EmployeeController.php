<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Department;
use App\Http\Requests\Admin\EmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department')
                            ->withTrashed()
                            ->orderBy('deleted_at')
                            ->get();
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::with('parent')
                                ->get()
                                ->mapWithKeys(function ($department) {
                                    return [$department->id => $department->title . ($department->parent ? " ({$department->parent->title})" : '')];
                                });
        return view('admin.employees.create', compact('departments'));
    }

    public function store(EmployeeRequest $request)
    {
        $employee = new Employee($request->input());

        if ($employee->save()) {
            return redirect()->route('admin.employees.edit', $employee)->withSuccess('Сотрудник успешно создан.');
        }
        return redirect()->route('admin.employees.create')
                ->withInput($request->input())
                ->withErrors('При создании сотрудника произошла ошибка. Пожалуйста повторите попытку снова');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::with('parent')
                                ->get()
                                ->mapWithKeys(function ($department) {
                                    return [$department->id => $department->title . ($department->parent ? " ({$department->parent->title})" : '')];
                                });
        return view('admin.employees.edit', compact('employee', 'departments'));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        if($request->input('active')) {
            if($employee->deleted_at) {
                $employee->restore();
            }
        } else {
            $employee->delete();
        }

        $result = $employee->update(array_filter($request->input()));
        $redirector = redirect()->route('admin.employees.edit', $employee);

        if ($result) {
            return $redirector->withSuccess('Запись успешно обновлена');
        }

        return $redirector->withInput($request->input())
                        ->withErrors('При обновлении записи произошла ошибка. Пожалуйста повторите попытку.');
    }

    public function destroy(Employee $employee)
    {
        $redirector = redirect()->route('admin.employees.index');

        if ($employee->delete()) {
            return $redirector->withSuccess('Запись успешно удалена');
        }

        return $redirector->withErrors('При удалении записи произошла ошибка. Пожалуйста повторите попытку.');
    }
}
