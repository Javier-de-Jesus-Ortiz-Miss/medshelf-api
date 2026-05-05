<?php

namespace App\Providers\Core\Home\Item\Service;

use App\Core\Home\Item\Model\Product;
use App\Core\Home\Item\Model\Repository\ProductRepository;
use App\Core\Home\Item\Model\ValueObject\ConsumptionType;

final readonly class ProductRepositoryAdapter implements ProductRepository
{
    public function __construct(
        private \App\Core\Catalog\Product\Model\Repository\ProductRepository $repository,
    )
    {
    }

    public function findById(int $id): ?Product
    {
        $product = $this->repository->findById($id);
        if (!$product) return null;
        return new Product(
            id: $product->getId(),
            contentValue: $product->getNetContent()?->value,
            totalQuantity: $product->getTotalQuantity(),
            consumptionType: ConsumptionType::from($product->getPharmaceuticalForm()->consumptionType->value),
        );
    }
}