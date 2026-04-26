<?php

namespace App\Core\Product\Application\Service;

use App\Core\Product\Model\MedicalProductRepository;
use InvalidArgumentException;

final readonly class DeleteMedicalProductService
{
    public function __construct(
        private MedicalProductRepository $repository
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
