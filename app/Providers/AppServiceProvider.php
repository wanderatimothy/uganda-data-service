<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use ProtoneMedia\LaravelXssProtection\Middleware\XssCleanInput;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        XssCleanInput::skipKeyWhen(function (string $key, $value, Request $request) {
            return in_array($key, [
                'current_password',
                'password',
                'password_confirmation',
            ]);
        });
    }
}
