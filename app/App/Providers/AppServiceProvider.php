<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // If you're using Laravel Mix, you can
        // use the mix-manifest.json for this.
        Inertia::version(function () {
            return md5_file(public_path('mix-manifest.json'));
        });

        Inertia::share([
            'app' => [
                'name' => Config::get('app.name')
            ],
            'auth' => function () {
                return [
                    'user' => Auth::user() ? [
                        'id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'role' => Auth::user()->role,
                        'permissions' => Auth::user()->getAllPermissions()->pluck('name')->toArray()
                    ] : null,
                ];
            },
            'flash' => function () {
                if (Session::has('success')) {
                    return [
                        'message' => Session::get('success'),
                        'type' => 'success'
                    ];
                }

                if (Session::has('error')) {
                    return [
                        'message' => Session::get('error'),
                        'type' => 'error'
                    ];
                }

                if (Session::has('info')) {
                    return [
                        'message' => Session::get('info'),
                        'type' => 'info'
                    ];
                }

                if (Session::has('warning')) {
                    return [
                        'message' => Session::get('warning'),
                        'type' => 'warning'
                    ];
                }

                return null;
            },
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
        ]);
    }
}
