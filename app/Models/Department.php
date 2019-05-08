<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'title',
        'parent_id',
    ];

    public $timestamps = false;

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
