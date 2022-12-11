<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, FilamentUser, HasName
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<bool, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'email_verified_at',
        'role',
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

    public function sendPasswordResetNotification($token): void
    {
        $url = config('app.front_url').'/reset-password/'.$token;
        $this->notify(new ResetPasswordNotification($url));
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

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function developer(): HasOne
    {
        return $this->hasOne(Developer::class);
    }

    public function canAccessFilament(): bool
    {
        if (Auth::user()->role == 2) {
            return true;
        } else {
            Auth::logout();
            return false;
        }
    }

    public function getFilamentName(): string
    {
        return "{$this->firstname} {$this->lastname}";
    }
}
