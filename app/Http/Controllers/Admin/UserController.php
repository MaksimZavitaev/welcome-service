<?php


namespace App\Http\Controllers\Admin;


use App\Models\User;

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
    }

    public function store()
    {
    }

    public function update(User $user)
    {
    }

    public function destroy(User $user)
    {
        $redirector = redirect()->route('admin.users.index');

        if ($user->delete()) {
            return $redirector->withSuccess('Пользователь успешно удален');
        }

        return $redirector->withErrors('При удалении пользователя произошла ошибка. Пожалуйста повторите попытку');
    }
}
