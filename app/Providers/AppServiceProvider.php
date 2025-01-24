<?php

namespace App\Providers;

use App\Broadcasting\MelipayamakChannel;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     * @throws BindingResolutionException|\Exception
     */
    public function boot(): void
    {
        try {
            $this->app->make(ChannelManager::class)->extend('melipayamak', function ($app) {
                return new MelipayamakChannel();
            });
            view()->composer('*', function ($view) {
                if (!Auth::check() && Cookie::has('remember_token')) {
                    $user = User::query()->where('remember_token', Cookie::get('remember_token'))->first();

                    if ($user) {
                        Auth::login($user);
                    }
                }
            });
        } catch (BindingResolutionException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
