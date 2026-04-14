<?php

namespace App\core\product\model;

interface ProductRepository
{
    public function findById(string $id): ?Product;

    public function save(Product $product): void;

    public function deleteById(string $id): void;

    public function exists(string $id): bool;
}
