<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrImage extends Model
{
    use HasFactory;

    protected $guard = [
        'id',
    ];

    protected $fillable = [
        'description',
        'valid_from',
        'expired',
        'image',
        'amount',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
