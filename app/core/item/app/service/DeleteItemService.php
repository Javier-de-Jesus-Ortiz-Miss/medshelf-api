<?php

namespace App\core\item\app\service;

use App\core\item\app\port\DeleteItem;
use App\core\item\model\ItemRepository;
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
