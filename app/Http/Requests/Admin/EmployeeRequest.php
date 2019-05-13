<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasRole('administrator');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $employee = $this->route('employee');

        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'patronymic' => 'required|string|max:255',
            'position' => 'required',
            'email' => 'required|email|unique:employees,email'.($employee ? ",$employee->id" : ''),
            'mobile_number' => 'required|regex:/^\+7\-[0-9]{3}\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}/i',
            'work_number' => 'required|regex:/^\+7\-[0-9]{3}\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}/i',
            'extension_number' => 'required|numeric',
            'department_id' => 'required|exists:departments,id'
        ];
    }
}
