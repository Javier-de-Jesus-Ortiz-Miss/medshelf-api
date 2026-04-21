<?php

namespace App\Core\Product\Model;

interface MedicalProductRepository
{
    public function findById(string $id): ?MedicalProduct;

    public function save(MedicalProduct $product): void;

    public function deleteById(string $id): void;

    public function exists(string $id): bool;
}
