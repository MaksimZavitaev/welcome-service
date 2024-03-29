<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'key',
        'name',
        'values',
    ];

    protected $casts =[
        'values' => 'array',
    ];
}
