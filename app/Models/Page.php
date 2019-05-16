<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Page extends Model
{
    protected $fillable = [
        'slug',
        'author_id',
        'category_id',
        'title',
        'content',
        'announcement',
        'video',
        'block',
        'steps',
    ];

    protected $casts = [
        'steps' => 'array',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
