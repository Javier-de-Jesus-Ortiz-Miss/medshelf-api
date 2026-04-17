<?php

namespace App\Core\Product\Application\Service;

use App\Core\Product\Application\Port\DeleteProduct;
use App\Core\Product\Model\ProductRepository;
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
