<?php

namespace App\core\inventory\app\service;

use App\core\inventory\app\dto\request\CreateInventoryRequest;
use App\core\inventory\app\dto\response\InventoryResponse;
use App\core\inventory\app\mapping\InventoryMapper;
use App\core\inventory\app\port\CreateInventory;
use App\core\inventory\model\Inventory;
use App\core\inventory\model\InventoryRepository;

final readonly class CreateInventoryService implements CreateInventory
{
    public function __construct(
        private InventoryRepository $repository
    )
    {
    }

    public function execute(CreateInventoryRequest $request): InventoryResponse
    {
        $inventory = Inventory::create(
            ownerId: $request->ownerId,
            name: $request->name
        );
        $this->repository->save($inventory);
        return InventoryMapper::toInventoryResponse($inventory);
    }
}
