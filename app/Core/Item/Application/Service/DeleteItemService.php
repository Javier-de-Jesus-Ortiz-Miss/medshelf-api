<?php

namespace App\Core\Item\Application\Service;

use App\Core\Item\Application\Port\DeleteItem;
use App\Core\Item\Model\ItemRepository;
use InvalidArgumentException;

final readonly class DeleteItemService implements DeleteItem
{
    public function __construct(
        private ItemRepository $repository
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
