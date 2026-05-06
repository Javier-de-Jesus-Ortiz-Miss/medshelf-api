<?php

namespace App\Core\Home\Item\Model\Repository;

use App\Core\Home\Item\Model\Product;

interface ProductRepository
{
    public function findById(string $id): ?Product;
}