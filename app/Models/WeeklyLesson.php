<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'tema',
        'description',
        'date',
        'archive',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
