<?php

namespace App\Core\Item\Application\UseCase;

use App\Core\Item\Model\MedicalItemRepository;
use InvalidArgumentException;

final readonly class DeleteMedicalItem
{
    public function __construct(
        private MedicalItemRepository $repository
    )
    {
    }

    public function execute($itemId): void
    {
        if (!$this->repository->exists($itemId)) {
            throw new InvalidArgumentException("Item with id $itemId not found");
        }
        $this->repository->deleteById($itemId);
    }
}
