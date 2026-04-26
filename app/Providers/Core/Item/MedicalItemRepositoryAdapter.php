<?php

namespace App\Providers\Core\Item;

use App\Core\Item\Model\Consumption;
use App\Core\Item\Model\MedicalItem;
use App\Core\Item\Model\MedicalItemRepository;
use App\Models\ConsumptionModel;
use App\Models\ItemModel;

class MedicalItemRepositoryAdapter implements MedicalItemRepository
{
    public function findById(string $id): ?MedicalItem
    {
        $itemModel = ItemModel::with(['product', 'storage', 'consumptions'])
            ->where('public_id', $id)
            ->first();
        if (!$itemModel) {
            return null;
        }
        return $this->toDomain($itemModel);
    }

    private function toDomain(ItemModel $itemModel): MedicalItem
    {
        return MedicalItem::load(
            id: $itemModel->public_id,
            productId: $itemModel->product->public_id,
            storageUnitId: $itemModel->storage->public_id,
            totalQuantity: $itemModel->total_quantity,
            consumptions: $itemModel->consumptions->map(fn($consumption) => Consumption::load(
                id: $consumption->public_id,
                itemId: $consumption->item_id,
                amount: $consumption->amount,
                consumptionAt: $consumption->consumed_at
            ))->toArray(),
            expirationDate: $itemModel->expiration_date,
            addedDate: $itemModel->created_at,
        );
    }

    public function save(MedicalItem $item): void
    {
        $itemModel = ItemModel::updateOrCreate(
            ['public_id' => $item->getId()],
            [
                'product_id' => $item->getMedicalProductId(),
                'storage_id' => $item->getStorageUnitId(),
                'total_quantity' => $item->getTotalQuantity(),
                'expiration_date' => $item->getExpirationDate(),
            ]
        );
        $itemModel->save();
    }

    public function deleteById(string $id): void
    {
        ItemModel::where('public_id', $id)->delete();
    }

    public function exists(string $id): bool
    {
        return ItemModel::where('public_id', $id)->exists();
    }

    public function consume(Consumption $consumption): void
    {
        ConsumptionModel::firstOrCreate(
            ['public_id' => $consumption->getId()],
            [
                'item_id' => $consumption->getMedicalItemId(),
                'amount' => $consumption->getAmount(),
                'consumed_at' => $consumption->getConsumptionDate(),
            ]
        );
    }
}
