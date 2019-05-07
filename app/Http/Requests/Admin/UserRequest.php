<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use App\Rules\AlphaName;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasPermissionTo('create users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->route('user');

        $rules = [
            'name' => ['required', 'string', 'max:255', new AlphaName],
            'email' => 'required|email|unique:users,email,' . ($user ? $user->id : $this->user()->id),
            'permissions.*' => 'exists:permissions,id',
            'roles.*' => 'exists:roles,id',
        ];

        if (empty($user)) {
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        return $rules;
    }
}
