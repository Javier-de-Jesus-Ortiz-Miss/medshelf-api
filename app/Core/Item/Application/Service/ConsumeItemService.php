<?php

namespace App\Core\Item\Application\Service;

use App\Core\Item\Application\Dto\Request\ConsumeItemRequest;
use App\Core\Item\Application\Dto\Response\ItemResponse;
use App\Core\Item\Application\Mapping\ItemMapper;
use App\Core\Item\Application\Port\ConsumeItem;
use App\Core\Item\Model\ItemRepository;
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
