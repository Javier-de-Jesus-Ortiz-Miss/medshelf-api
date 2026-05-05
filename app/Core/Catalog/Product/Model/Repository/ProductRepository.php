<?php

namespace App\Core\Catalog\Product\Model\Repository;

use App\Core\Catalog\Product\Model\Product;

interface ProductRepository
{
    public function findById(string $id): ?Product;

    public function save(Product $product): void;

    public function remove(Product $product): void;

    public function existsActiveIngredient(string $name): bool;
}
