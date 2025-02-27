<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'priority',
        'category',
        'due_date',
        'due_time',
        'is_completed',
        'completed'
    ];

    protected $casts = [
        'due_date' => 'date',
        'due_time' => 'datetime',
        'is_completed' => 'boolean',
    ];
} 