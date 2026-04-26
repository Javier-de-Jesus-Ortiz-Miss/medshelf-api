<?php

namespace App\Providers\Core\Item;

use App\Core\Item\Application\Port\ConsumptionReadRepository;
use App\Core\Item\Application\Port\MedicalItemReadRepository;
use App\Core\Item\Model\MedicalItemRepository;
use App\Providers\CoreProvider;

class ItemServiceProvider extends CoreProvider
{

    protected function registerRepositories(): void
    {
        $this->app->singleton(MedicalItemReadRepository::class, MedicalItemReadRepositoryAdapter::class);
        $this->app->singleton(MedicalItemRepository::class, MedicalItemRepositoryAdapter::class);
        $this->app->singleton(ConsumptionReadRepository::class, COnsumptionReadRepositoryAdapter::class);
    }
}
