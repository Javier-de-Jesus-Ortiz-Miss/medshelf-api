<?php

namespace App\Providers\Core\Catalog\Product;

use App\Core\Catalog\Product\Model\Repository\ProductRepository;
use App\Providers\Core\Catalog\Product\Service\ProductRepositoryAdapter;
use App\Providers\CoreProvider;

class ProductServiceProvider extends CoreProvider
{

    protected function registerRepositories(): void
    {
        $this->app->singleton(ProductRepository::class, ProductRepositoryAdapter::class);
    }
}
