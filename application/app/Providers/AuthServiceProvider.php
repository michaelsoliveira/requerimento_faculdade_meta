<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Auth\EloquentUserProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Registra um provedor de autenticação personalizado
    Auth::provider('sha512', function ($app, array $config) {
        return new class($app['hash'], $config['model']) extends EloquentUserProvider {
            public function validateCredentials($user, array $credentials)
            {
                $plain = $credentials['password'];
                $hashed = $user->getAuthPassword();

                return hash_equals($hashed, crypt($plain, $hashed));
            }
        };
    });
}
}
    

