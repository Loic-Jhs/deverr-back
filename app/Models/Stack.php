<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stack extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'logo',
        'created_at',
        'updated_at',
    ];

    public function developerStack(): HasMany
    {
        return $this->hasMany(Stack::class);
    }

    public function developers(): BelongsToMany
    {
        return $this->belongsToMany(Developer::class);
    }
}
