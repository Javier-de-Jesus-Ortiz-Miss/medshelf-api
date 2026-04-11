<?php

namespace App\Providers\inventory;

use App\core\inventory\model\PackageProduct;
use App\core\inventory\model\PackageProductRepository;
use App\Providers\mocks\inventory\ProductStorage;

class PackageProductRepositoryAdapter implements PackageProductRepository
{
    function save(PackageProduct $packageProduct): void
    {

        ProductStorage::$storage[$packageProduct->id] = $packageProduct;
    }

    function update(PackageProduct $packageProduct): void
    {
        ProductStorage::$storage[$packageProduct->id] = $packageProduct;
    }

    function deleteById(string $id): void
    {
        unset(ProductStorage::$storage[$id]);
    }

    function findById(string $id): ?PackageProduct
    {
        return ProductStorage::$storage[$id] ?? null;
    }
}
