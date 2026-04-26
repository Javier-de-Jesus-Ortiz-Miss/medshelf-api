<?php

namespace App\Providers\Core\Product;

use App\Core\Product\Application\Port\MedicalProductReadRepository;
use App\Core\Product\Model\MedicalProductRepository;
use App\Providers\CoreProvider;

class ProductServiceProvider extends CoreProvider
{

    protected function registerRepositories(): void
    {
        $this->app->singleton(MedicalProductReadRepository::class, MedicalProductReadRepositoryAdapter::class);
        $this->app->singleton(MedicalProductRepository::class, MedicalProductRepositoryAdapter::class);
    }
}
