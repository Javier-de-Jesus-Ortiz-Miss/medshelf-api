<?php

namespace App\Core\Home\Item\Application\UseCase;

use App\Core\Home\Item\Application\Dto\Request\RemoveItemRequest;
use App\Core\Home\Item\Application\Exception\ItemNotFound;
use App\Core\Home\Item\Model\Repository\ItemRepository;

final readonly class RemoveItem
{
    public function __construct(
        private ItemRepository $repository
    )
    {
    }

    public function execute(RemoveItemRequest $request): void
    {
        $item = $this->repository->findByIdAndHouseId($request->itemId, $request->houseId) ??
            throw new ItemNotFound("Item with id $request->itemId not found");
        $this->repository->remove($item);
    }
}
