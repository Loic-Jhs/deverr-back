<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'avatar',
        'years_of_experience',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->where('email_verified_at', '!=', null)
            ->where('deleted_at', null);
    }

    public function developerStacks(): HasMany
    {
        return $this->hasMany(DeveloperStack::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function stacks(): BelongsToMany
    {
        return $this->belongsToMany(Stack::class, 'developer_stacks', 'developer_id', 'stack_id')->withPivot('stack_experience', 'is_primary');
    }

    public function primaryStack(): BelongsToMany
    {
        return $this->belongsToMany(Stack::class, 'developer_stacks', 'developer_id', 'stack_id')->wherePivot('is_primary', true);
    }

    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(
            Review::class,
            Order::class,
            'developer_id',
            'order_id',
            'id',
            'id'
        );
    }

    public function developerPrestations(): HasManyThrough
    {
        return $this->hasManyThrough(DeveloperPrestation::class,
            PrestationType::class,
            'id', // Foreign key on the developer_prestations table
            'prestation_type_id',
            'id',
            'id'
        );
    }

    public function complaints(): HasManyThrough
    {
        return $this->hasManyThrough(
            Complaint::class,
            Order::class,
            'developer_id',
            'order_id',
            'id',
            'id'
        );
    }
}
