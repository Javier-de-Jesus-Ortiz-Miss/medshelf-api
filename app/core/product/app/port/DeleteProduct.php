<?php

namespace App\core\product\app\port;

interface DeleteProduct
{
    public function execute(string $productId): void;
}
