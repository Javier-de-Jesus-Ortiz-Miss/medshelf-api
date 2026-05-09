<?php

namespace App\Core\Home\Item\Application\UseCase;

use App\Core\Home\House\Application\Exception\PlaceNotFound;
use App\Core\Home\House\Model\Repository\PlaceRepository;
use App\Core\Home\Item\Application\Dto\Request\AddItemRequest;
use App\Core\Home\Item\Application\Dto\Response\ItemResponse;
use App\Core\Home\Item\Application\Exception\ProductNotFound;
use App\Core\Home\Item\Application\Mapping\ItemMapper;
use App\Core\Home\Item\Model\Item;
use App\Core\Home\Item\Model\Repository\ItemRepository;
use App\Core\Home\Item\Model\Repository\ProductRepository;
use App\Core\Home\Item\Model\ValueObject\ConsumptionType;
use App\Core\Home\Storage\Application\Exception\StorageNotFound;
use App\Core\Home\Storage\Model\Repository\StorageRepository;

final readonly class AddItem
{
    public function __construct(
        private ItemRepository    $itemRepository,
        private StorageRepository $storageRepository,
        private PlaceRepository   $placeRepository,
        private ProductRepository $productExternalRepository
    )
    {
    }

    public function execute(AddItemRequest $request): ItemResponse
    {
        $place = $this->placeRepository->findByIdAndHouseId($request->placeId, $request->houseId) ??
            throw new PlaceNotFound($request->placeId);
        $storage = $this->storageRepository->getDefaultStorageForPlace($place->getId(), $place->getHouseId()) ??
            throw new StorageNotFound($place->getId());
        $product = $this->productExternalRepository->findById($request->productId) ??
            throw new ProductNotFound($request->productId);
        $totalContent = match ($product->consumptionType) {
            ConsumptionType::DISCRETE => $product->totalQuantity,
            ConsumptionType::CONTINUOUS, ConsumptionType::APPLICABLE => $product->contentValue,
        };
        $item = Item::create(
            productId: $request->productId,
            storageUnitId: $storage->getId(),
            totalContent: $totalContent,
            expirationDate: $request->expirationDate
        );
        $this->itemRepository->save($item);
        return ItemMapper::toItemResponse($item, $storage->getPlaceId());
    }
}
