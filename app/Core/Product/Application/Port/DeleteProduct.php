<?php

namespace App\Core\Product\Application\Port;

interface DeleteProduct
{
    public function execute(string $productId): void;
}
