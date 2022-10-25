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
        'firstname',
        'lastname',
        'email',
        'description',
        'avatar',
        'years_of_experience',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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

    public function stacks()
    {
        return $this->hasManyThrough(
            Stack::class,
            DeveloperStack::class,
            'developer_id',
            'id',
            'id',
            'stack_id'
        );
    }
}
