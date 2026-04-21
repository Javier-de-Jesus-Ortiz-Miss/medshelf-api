<?php

namespace App\Core\Item\Application\Service;

use App\Core\Item\Application\Dto\Request\AddMedicalItemRequest;
use App\Core\Item\Application\Dto\Response\MedicalItemResponse;
use App\Core\Item\Application\Mapping\MedicalItemMapper;
use App\Core\Item\Application\Port\AddMedicalItem;
use App\Core\Item\Model\MedicalItem;
use App\Core\Item\Model\MedicalItemRepository;

final readonly class AddMedicalItemService implements AddMedicalItem
{
    public function __construct(
        private MedicalItemRepository $inventoryItemRepository
    )
    {
    }

    public function execute(AddMedicalItemRequest $request): MedicalItemResponse
    {
        $item = MedicalItem::create(
            productId: $request->medicalProductId,
            inventoryId: $request->storageUnitId,
            totalQuantity: $request->totalQuantity,
            expirationDate: $request->expirationDate
        );
        $this->inventoryItemRepository->save($item);
        return MedicalItemMapper::toItemResponse($item);
    }
}
