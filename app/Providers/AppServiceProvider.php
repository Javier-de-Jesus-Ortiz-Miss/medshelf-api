<?php

namespace App\Providers;

use App\core\inventory\app\port\AddProduct;
use App\core\inventory\app\port\ProductOnlyRead;
use App\core\inventory\app\service\AddProductService;
use App\core\inventory\model\PackageProductRepository;
use App\Providers\inventory\PackageProductRepositoryAdapter;
use App\Providers\inventory\ProductOnlyReadAdapter;
use App\Providers\mocks\inventory\ProductStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AddProduct::class, AddProductService::class);
        $this->app->singleton(PackageProductRepository::class, PackageProductRepositoryAdapter::class);
        $this->app->singleton(ProductOnlyRead::class, ProductOnlyReadAdapter::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ProductStorage::load();
        $this->app->terminating(function () {
            ProductStorage::persist();
        });
    }
}
