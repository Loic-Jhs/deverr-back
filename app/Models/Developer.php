<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Developer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'description',
        'experience',
        'created_at',
        'updated_at',
    ];

    public function developerPrestations(): HasMany
    {
        return $this->hasMany(DeveloperPrestation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function developerStacks(): HasMany
    {
        return $this->hasMany(DeveloperStack::class);
    }

    public function developers(): HasMany
    {
        return $this->hasMany(Developer::class);
    }
}
