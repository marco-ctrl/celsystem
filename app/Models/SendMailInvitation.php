<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendMailInvitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'status',
        'lider_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
