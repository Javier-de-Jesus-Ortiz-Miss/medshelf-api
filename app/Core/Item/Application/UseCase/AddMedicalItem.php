<?php

namespace App\Core\Item\Application\UseCase;

use App\Core\Item\Application\Dto\Request\AddMedicalItemRequest;
use App\Core\Item\Application\Dto\Response\MedicalItemResponse;
use App\Core\Item\Application\Mapping\MedicalItemMapper;
use App\Core\Item\Model\MedicalItem;
use App\Core\Item\Model\MedicalItemRepository;
use App\Core\Storage\Model\StorageUnit;
use App\Core\Storage\Model\StorageUnitRepository;

final readonly class AddMedicalItem
{
    public function __construct(
        private MedicalItemRepository $medicalItemRepository,
        private StorageUnitRepository $storageUnitRepository,
    )
    {
    }

    public function execute(AddMedicalItemRequest $request): MedicalItemResponse
    {
        $storageUnit = StorageUnit::create(
            placeId: $request->placeId,
            name: $request->placeName
        );
        $this->storageUnitRepository->save($storageUnit);
        $item = MedicalItem::create(
            productId: $request->medicalProductId,
            storageUnitId: $storageUnit->getId(),
            totalQuantity: $request->totalQuantity,
            expirationDate: $request->expirationDate
        );
        $this->medicalItemRepository->save($item);
        return MedicalItemMapper::toItemResponse($item, $request->placeId);
    }
}
