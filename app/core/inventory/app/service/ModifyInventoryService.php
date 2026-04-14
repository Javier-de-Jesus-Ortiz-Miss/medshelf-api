<?php

namespace App\core\inventory\app\service;

use App\core\inventory\app\dto\request\ModifyInventoryRequest;
use App\core\inventory\app\dto\response\InventoryResponse;
use App\core\inventory\app\mapping\InventoryMapper;
use App\core\inventory\app\port\ModifyInventory;
use App\core\inventory\model\InventoryRepository;
use InvalidArgumentException;

final readonly class ModifyInventoryService implements ModifyInventory
{
    public function __construct(
        private InventoryRepository $repository
    )
    {
    }

    public function execute(ModifyInventoryRequest $request): InventoryResponse
    {
        $inventory = $this->repository->findById($request->inventoryId) ??
            throw new InvalidArgumentException("Inventory with id $request->inventoryId not found");
        $inventory->changeName($request->name);
        $this->repository->save($inventory);
        return InventoryMapper::toInventoryResponse($inventory);
    }
}
