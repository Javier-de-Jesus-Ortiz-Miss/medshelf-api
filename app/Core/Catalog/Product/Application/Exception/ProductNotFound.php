<?php

namespace App\Core\Catalog\Product\Application\Exception;

use App\Core\Shared\Application\AppException;

class ProductNotFound extends AppException
{
    public function __construct(string $productId)
    {
        parent::__construct('Product not found for id: ' . $productId);
    }
}