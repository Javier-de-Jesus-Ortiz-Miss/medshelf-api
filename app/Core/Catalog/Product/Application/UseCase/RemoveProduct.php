<?php

namespace App\Core\Catalog\Product\Application\UseCase;

use App\Core\Catalog\Product\Application\Exception\ProductNotFound;
use App\Core\Catalog\Product\Model\Repository\ProductRepository;

final readonly class RemoveProduct
{
    public function __construct(
        private ProductRepository $repository
    )
    {
    }

    public function execute(string $productId): void
    {
        $product = $this->repository->findById($productId) ??
            throw new ProductNotFound($productId);
        $this->repository->remove($product);
    }
}
