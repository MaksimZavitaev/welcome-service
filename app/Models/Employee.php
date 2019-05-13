<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'department_id',
        'position',
        'firstname',
        'lastname',
        'patronymic',
        'email',
        'mobile_number',
        'work_number',
        'extension_number',
    ];

    public function getFullnameAttribute(): string
    {
        return title_case(("{$this->lastname} {$this->firstname}").(" {$this->patronymic}" ?? ''));
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
