<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        File::put(storage_path('logs/laravel.log'), '');
        // Vite prefetch configuration
        Vite::prefetch(concurrency: 3);

        // Sharing auth user data with Inertia
        Inertia::share('auth', function () {
            $user = Auth::user();

            return [
                'user' => $user ? [
                    'name' => $user->name,
                    'email' => $user->email,
                     'roles' => $user->roles->pluck('name')->toArray(),
                ] : null,
            ];
        });
    }
}