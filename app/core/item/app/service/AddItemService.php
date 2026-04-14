<?php

namespace App\core\item\app\service;

use App\core\item\app\dto\request\AddItemRequest;
use App\core\item\app\dto\response\ItemResponse;
use App\core\item\app\mapping\ItemMapper;
use App\core\item\app\port\AddItem;
use App\core\item\model\Item;
use App\core\item\model\ItemRepository;

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
            inventoryId: $request->inventoryId,
            totalQuantity: $request->quantity,
            expirationDate: $request->expirationDate
        );
        $this->inventoryItemRepository->save($item);
        return ItemMapper::toItemResponse($item);
    }
}
