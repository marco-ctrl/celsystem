<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'contact',
        'tipe',
        'celula_id',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function celula(): BelongsTo
    {
        return $this->belongsTo(Celula::class);
    }

    public function asistencia(): HasMany
    {
        return $this->hasMany(Assistant::class);
    }

    public function visita(): HasMany
    {
        return $this->hasMany(Visit::class);
    }
}
