<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

abstract class CoreProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerRepositories();
    }

    abstract protected function registerRepositories(): void;
}
