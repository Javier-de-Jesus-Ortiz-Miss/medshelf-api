<?php

namespace App\Core\Item\Application\Service;

use App\Core\Item\Application\Dto\Request\AddItemRequest;
use App\Core\Item\Application\Dto\Response\ItemResponse;
use App\Core\Item\Application\Mapping\ItemMapper;
use App\Core\Item\Application\Port\AddItem;
use App\Core\Item\Model\Item;
use App\Core\Item\Model\ItemRepository;

final readonly class AddItemService implements AddItem
{
    public function __construct(
        private ItemRepository $inventoryItemRepository
    )
    {
    }

    public function execute(AddItemRequest $request): ItemResponse
    {
        $item = Item::create(
            productId: $request->productId,
            inventoryId: $request->storageUnitId,
            totalQuantity: $request->quantity,
            expirationDate: $request->expirationDate
        );
        $this->inventoryItemRepository->save($item);
        return ItemMapper::toItemResponse($item);
    }
}
