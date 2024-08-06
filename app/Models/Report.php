<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'assistant',
        'visit',
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
}
