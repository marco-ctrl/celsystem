<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

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
        'name_celula',
        'lider',
        'latitude',
        'length',
        'address'
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

    /**
     * Get the sum of assistant_amount per month for a given year.
     *
     * @param int $year
     * @return \Illuminate\Support\Collection
     */
    public static function getMonthlyAssistantAmountSumByYear(int $year)
    {
        return self::select(
                DB::raw('MONTH(datetime) as month'),
                DB::raw('SUM(assistant_amount) as total_assistant_amount')
            )
            ->whereYear('datetime', $year)
            ->groupBy(DB::raw('MONTH(datetime)'))
            ->get();
    }
}
