<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string, bool>
     */
    protected $fillable = [
        'client_id',
        'dev_prestation_id',
        'reference',
        'is_payed',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function developerPrestation(): BelongsTo
    {
        return $this->BelongsTo(DeveloperPrestation::class);
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
