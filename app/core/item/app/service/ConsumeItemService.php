<?php

namespace App\core\item\app\service;

use App\core\item\app\dto\request\ConsumeItemRequest;
use App\core\item\app\dto\response\ItemResponse;
use App\core\item\app\mapping\ItemMapper;
use App\core\item\app\port\ConsumeItem;
use App\core\item\model\ItemRepository;
use InvalidArgumentException;

final readonly class ConsumeItemService implements ConsumeItem
{
    public function __construct(
        private ItemRepository $repository
    )
    {
    }

    public function execute(ConsumeItemRequest $request): ItemResponse
    {
        $item = $this->repository->findById($request->itemId) ??
            throw new InvalidArgumentException("Item with id $request->itemId not found");
        $item->consume($request->quantity);
        $this->repository->save($item);
        return ItemMapper::toItemResponse($item);
    }
}
