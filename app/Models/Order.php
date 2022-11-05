<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string, bool>
     */
    protected $fillable = [
        'user_id',
        'developer_id',
        'developer_prestation_id',
        'instructions',
        'is_finished',
        'is_accepted_by_developer',
        'is_payed',
        'stripe_session_id',
        'reference',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    public function developerPrestation(): BelongsTo
    {
        return $this->belongsTo(DeveloperPrestation::class);
    }

    public function complaint(): HasOne
    {
        return $this->hasOne(Complaint::class);
    }
}
