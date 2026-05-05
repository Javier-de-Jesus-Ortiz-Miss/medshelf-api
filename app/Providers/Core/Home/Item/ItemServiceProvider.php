<?php

namespace App\Providers\Core\Home\Item;

use App\Core\Home\Item\Model\Repository\ConsumptionRepository;
use App\Core\Home\Item\Model\Repository\ItemRepository;
use App\Core\Home\Item\Model\Repository\ProductRepository;
use App\Providers\Core\Home\Item\Service\ConsumptionRepositoryAdapter;
use App\Providers\Core\Home\Item\Service\ItemRepositoryAdapter;
use App\Providers\Core\Home\Item\Service\ProductRepositoryAdapter;
use App\Providers\CoreProvider;

class ItemServiceProvider extends CoreProvider
{

    protected function registerRepositories(): void
    {
        $this->app->singleton(ItemRepository::class, ItemRepositoryAdapter::class);
        $this->app->singleton(ProductRepository::class, ProductRepositoryAdapter::class);
        $this->app->singleton(ConsumptionRepository::class, ConsumptionRepositoryAdapter::class);
    }
}
