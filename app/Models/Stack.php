<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function stack(): belongsToMany
    {
        return $this->belongsToMany(Developer::class)->withPivot('stack_experience', 'is_primary');
    }

    public function developers(): BelongsToMany
    {
        return $this->belongsToMany(Developer::class);
    }
}
