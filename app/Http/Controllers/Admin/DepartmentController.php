<?php


namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\DepartmentRequest;
use App\Models\Department;

class DepartmentController
{
    public function index()
    {
        $pid = request()->input('pid');
        $departments = Department::with('parent')
                                 ->where('parent_id', $pid)
                                 ->withCount('childs')
                                 ->get();

        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create', [
            'departments' => Department::with('parent')->get()->mapWithKeys(function ($department) {
                return [$department->id => $department->title . ($department->parent ? " ({$department->parent->title})" : '')];
            }),
        ]);
    }

    public function store(DepartmentRequest $request)
    {
        $department = new Department($request->input());

        if ($department->save()) {
            return redirect()->route('admin.departments.index', ['pid' => $department->parent_id])->withSuccess('Департамент успешно создан.');
        }

        return redirect()->route('admin.departments.create')
                         ->withInput($request->input())
                         ->withErrors('При создании департамента произошла ошибка');
    }

    public function edit(Department $department)
    {
        $departments = Department::with('parent')
                                 ->get()
                                 ->reject(function ($item) use ($department) {
                                     return $item->id === $department->id;
                                 })
                                 ->mapWithKeys(function ($department) {
                                     return [$department->id => $department->title . ($department->parent ? " ({$department->parent->title})" : '')];
                                 });
        return view('admin.departments.edit', compact('department', 'departments'));
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $result = $department->update(array_filter($request->input()));
        $redirector = redirect()->route('admin.departments.edit', $department);

        if ($result) {
            return $redirector->withSuccess('Запись успешно обновлена');
        }

        return $redirector->withInput($request->input())
                          ->withErrors('При обновлении записи произошла ошибка. Пожалуйста повторите попытку.');
    }

    public function destroy(Department $department)
    {
        $redirector = redirect()->route('admin.departments.index');

        if ($department->delete()) {
            return $redirector->withSuccess('Запись успешно удалена');
        }

        return $redirector->withErrors('При удалении записи произошла ошибка. Пожалуйста повторите попытку.');
    }
}
