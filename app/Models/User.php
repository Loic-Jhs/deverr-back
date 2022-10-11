<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<bool, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'firstname',
        'lastname',
        'role_id',
        'is_account_active',
        'remember_token',
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

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class, 'user_id');
    }

    public function passwordResets(): HasMany
    {
        return $this->hasMany(PasswordReset::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function developer(): HasOne
    {
        return $this->hasOne(Developer::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
