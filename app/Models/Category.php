<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'slug',
        'title',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function categories()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
