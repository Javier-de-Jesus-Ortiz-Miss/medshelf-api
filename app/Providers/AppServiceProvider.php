<?php

namespace App\Providers;

use App\Core\Shared\Application\EventPublisher;
use App\Providers\Core\LaravelEventPublisher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EventPublisher::class, LaravelEventPublisher::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
