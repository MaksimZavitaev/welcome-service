<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Department;
use App\Http\Requests\Admin\EmployeeRequest;
use App\Models\Page;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::withTrashed()
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

    public function updateFirstDayPage(Employee $employee)
    {
        $page = Page::whereSlug('first_day')->firstOrFail();
        $result = $employee->pages()->sync([$page->id => [
            'block' => request()->input('block'),
            'content' => request()->input('content'),
            'steps' => request()->input('steps'),
        ]]);
        $redirector = redirect()->route('admin.employees.edit', $employee);

        if(count($result['updated']) || count($result['attached'])) {
            return $redirector->withSuccess('Запись успешно обновлена.');
        }

        return $redirector->withInput(request()->input())->withErrors('При обнолении данных страницы произошла ошибка.');
    }

    public function deleteFirstDayPage(Employee $employee) {
        $page = Page::whereSlug('first_day')->firstOrFail();
        $result = $employee->pages()->detach($page->id);

        if(!request()->ajax()) {
            $redirector = redirect()->route('admin.employees.edit', $employee);

            if($result) {
                return $redirector->withSuccess('Запись успешно обновлена.');
            }
        
            return $redirector->withInput(request()->input())->withErrors('При обнолении данных страницы произошла ошибка.');
        }

        $response = [
            'redirect' => route('admin.employees.edit', $employee),
        ];

        if($result) {
            request()->session()->flash(
                'success', 'Запись успешно обновлена.'
            );
            return $response;
        }

        request()->session()->flash(
            'errors', 'При обнолении данных страницы произошла ошибка.'
        );
        return $response;

    }

    public function sendWelcomeMail(Employee $employee)
    {
        $employee->sendWelcomeMail();
        if(request()->ajax()) {
            request()->session()->flash('success', 'Письмо отправлено.');
            return ['status' => 'ok'];
        }
        return redirect()->route('admin.employees.edit', $employee)->withSuccess('Письмо отправлено.');
    }

    public function sendWelcomeSMS(Employee $employee)
    {
        if(request()->ajax()) {
            request()->session()->flash('success', 'Отправка SMS еще не реализована.');
            return ['status' => 'ok'];
        }
        return redirect()->route('admin.employees.edit', $employee)->withSuccess('Отправка SMS еще не реализована.');
    }

    public function generateShortLink(Employee $employee)
    {
        $employee->updated_at = now();
        $result = $employee->save();
        $success_message = 'Выполнено успешно.';
        $error_message = 'Во время генерации ссылки произошла ошибка.';

        if(request()->ajax()) {
            if($result) {
                request()->session()->flash('success', $success_message);
                return ['status' => 'ok'];
            }
            request()->session()->flash('errors', $error_message);
            return ['status' => 'error'];
        }

        $redirector = redirect()->route('admin.employees.edit', $employee);
        if($result) {
            return $redirector->withSuccess($success_message);
        }
        return $redirector->withSuccess($error_message);
    }
}
