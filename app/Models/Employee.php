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

    public function pages()
    {
        return $this->belongsToMany(Page::class)->using(EmployeePage::class)->withPivot('content', 'block', 'steps');
    }

    public function getFirstDayPage()
    {
        $page = $this->pages()->whereSlug('first_day')->first() ?? Page::whereSlug('first_day')->first();
        if(!$page) {
            return $page;
        }

        $page = $page->toArray();
        if(array_key_exists('pivot', $page)) {
            $page = array_merge($page, $page['pivot']);
            unset($page['pivot']);
        }

        return array2object($page);
    }
}
