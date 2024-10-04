<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assistant extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'report_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
