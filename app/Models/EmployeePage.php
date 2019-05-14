<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EmployeePage extends Pivot
{
    protected $casts = [
        'steps' => 'array',
    ];
}
