<?php

namespace App\Providers\Core\Home\House;

use App\Core\Home\House\Model\Repository\HouseRepository;
use App\Core\Home\House\Model\Repository\PlaceRepository;
use App\Providers\Core\Home\House\Service\HouseRepositoryAdapter;
use App\Providers\Core\Home\House\Service\PlaceRepositoryAdapter;
use App\Providers\CoreProvider;

class HouseServiceProvider extends CoreProvider
{
    protected function registerRepositories(): void
    {
        $this->app->singleton(HouseRepository::class, HouseRepositoryAdapter::class);
        $this->app->singleton(PlaceRepository::class, PlaceRepositoryAdapter::class);
    }
}
