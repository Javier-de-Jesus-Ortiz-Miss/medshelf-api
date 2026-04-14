<?php

namespace App\core\product\app\service;

use App\core\product\app\port\DeleteProduct;
use App\core\product\model\ProductRepository;
use InvalidArgumentException;

final readonly class DeleteProductService implements DeleteProduct
{
    public function __construct(
        private ProductRepository $repository
    )
    {
    }

    public function execute(string $productId): void
    {
        if (!$this->repository->exists($productId)) {
            throw new InvalidArgumentException("Product with id $productId not found");
        }
        $this->repository->deleteById($productId);
    }
}
