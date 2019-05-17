<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $redirector = redirect()->route('home');
        if($request->has('sign')) {
            $id = json_decode(decrypt($request->sign))->id;
            
            if ($this->guard()->check()) {
                if($this->guard()->user()->id !== $id) {
                    $this->guard()->logout();
                    $request->session()->invalidate();
                }
            }
            
            $employee = $this->guard()->loginUsingId($id);
            if($employee) {
                return $redirector;
            }
            return $redirector->withErrors('Во время авторизации произошла ошибка или пользователь удален.');
        }

        return $redirector;
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return \Auth::guard('employee');
    }
}
