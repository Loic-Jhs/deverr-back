<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Developer extends Model
{
    use HasFactory;

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
        return $this->hasMany(DeveloperStack::class, 'developer_id');
    }

    public function developers(): HasMany
    {
        return $this->hasMany(Developer::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'developer_id');
    }

    public function complaints(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Complaint::class, DeveloperPrestation::class, 'developer_id', 'dev_prestation_id');
    }

}
