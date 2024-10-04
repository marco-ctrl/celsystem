<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'datetime',
        'assistant_amount',
        'visit_amount',
        'offering',
        'payment_method',
        'voucher',
        'celula_id',
        'status',
        'photo',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function celula(): BelongsTo
    {
        return $this->belongsTo(Celula::class);
    }

    public function asistencia(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'assistants');
    }

    public function visita(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'visits');
    }
}
