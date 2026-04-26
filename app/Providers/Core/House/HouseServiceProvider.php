<?php

namespace App\Providers\Core\House;

use App\Core\House\Application\Port\HouseReadRepository;
use App\Core\House\Application\Port\PlaceReadRepository;
use App\Core\House\Model\HouseRepository;
use App\Providers\CoreProvider;

class HouseServiceProvider extends CoreProvider
{
    protected function registerRepositories(): void
    {
        $this->app->singleton(HouseReadRepository::class, HouseReadRepositoryAdapter::class);
        $this->app->singleton(PlaceReadRepository::class, PlaceReadRepositoryAdapter::class);
        $this->app->singleton(HouseRepository::class, HouseRepositoryAdapter::class);
    }
}
