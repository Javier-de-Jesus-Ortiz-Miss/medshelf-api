<?php

use App\Providers\AppServiceProvider;
use App\Providers\Core\Catalog\Product\ProductServiceProvider;
use App\Providers\Core\Home\House\HouseServiceProvider;
use App\Providers\Core\Home\Item\ItemServiceProvider;
use App\Providers\Core\Home\Storage\StorageProvider;

return [
    AppServiceProvider::class,
    HouseServiceProvider::class,
    ProductServiceProvider::class,
    ItemServiceProvider::class,
    StorageProvider::class,
];
