<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // customize email verification
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Vérifiez votre email DEVERR !')
                ->line('Veuillez cliquer sur le bouton ci-dessous pour valider votre adresse email.')
                ->action('Vérifier votre email', $url);
        });

        Gate::define('isAdmin', function () {
            return Auth::user()->role === 2;
        });

        Gate::define('isUser', function () {
            return Auth::user()->role === 0;
        });

        Gate::define('isDeveloper', function () {
            return Auth::user()->role === 1;
        });
    }
}
