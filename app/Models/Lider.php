<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'birthdate',
        'addres',
        'contact',
        'foto',
        'user_id',
        'status',

    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function celula(): HasOne
    {
        return $this->hasOne(Celula::class);
    }
}
