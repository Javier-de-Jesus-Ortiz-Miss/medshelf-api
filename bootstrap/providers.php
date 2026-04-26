<?php

use App\Providers\AppServiceProvider;
use App\Providers\Core\House\HouseServiceProvider;
use App\Providers\Core\Item\ItemServiceProvider;
use App\Providers\Core\Product\ProductServiceProvider;

return [
    AppServiceProvider::class,
    HouseServiceProvider::class,
    ProductServiceProvider::class,
    ItemServiceProvider::class,
];
