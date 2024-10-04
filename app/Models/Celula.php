<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Celula extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'name',
        'addres',
        'day',
        'hour',
        'latitude',
        'length',
        'lider_id',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function lider(): BelongsTo
    {
        return $this->belongsTo(Lider::class);
    }

    public function member(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    public function report(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
