<?php


namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UpdateUser;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::all(),
        ]);
    }

    public function create()
    {
        return view('admin.users.create', [
            'roles' => Role::pluck('name', 'id')->mapWithKeys(function ($name, $key) {
                return [$key => __('roles.' . $name)];
            }),
            'permissions' => Permission::pluck('name', 'id')->mapWithKeys(function ($name, $key) {
                return [$key => __('permissions.' . $name)];
            }),
        ]);
    }

    public function store(UserRequest $request)
    {
        \DB::transaction(function () use ($request) {
            $user = User::create($request->input());
            if ($user->save() && $user->syncRoles($request->get('roles', [])) && $user->syncPermissions($request->get('permissions', []))) {
                return redirect()->route('admin.users.edit', $user)->withSuccess('Пользователь успешно создан');
            }
            return redirect()->route('admin.users.create')
                ->withInput($request->input())
                ->withErrors('При создании пользователя произошла ошибка. Пожалуйста повторите попытку снова');
        });

    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id')->mapWithKeys(function ($name, $id) {
            return [$id => __('roles.' . $name)];
        });
        $permissions = Permission::pluck('name', 'id')->mapWithKeys(function ($name, $id) {
            return [$id => __('permissions.' . $name)];
        });
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update(array_filter($request->input()));
        $user->syncRoles($request->input('roles', []));
        $user->syncPermissions($request->input('permissions', []));

        return redirect()->route('admin.users.edit', $user)->withSuccess('Данные пользователя успешно обновлены.');
    }

    public function destroy(User $user)
    {
        $redirector = redirect()->route('admin.users.index');

        if (request()->user()->hasPermissionTo('delete users')) {
            if ($user->delete()) {
                return $redirector->withSuccess('Пользователь успешно удален');
            }
            return $redirector->withErrors('При удалении пользователя произошла ошибка. Пожалуйста повторите попытку');
        }
        return $redirector->withErrors('У Вас нет прав на удаление пользователей');
    }
}
