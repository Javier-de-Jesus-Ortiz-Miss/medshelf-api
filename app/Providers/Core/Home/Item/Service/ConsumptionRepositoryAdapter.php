<?php

namespace App\Providers\Core\Home\Item\Service;

use App\Core\Home\Item\Model\Consumption;
use App\Core\Home\Item\Model\Repository\ConsumptionRepository;
use App\Models\ConsumptionModel;
use App\Models\ItemModel;
use App\Providers\Core\InfrastructureException;

class ConsumptionRepositoryAdapter implements ConsumptionRepository
{

    public function consume(Consumption $consumption): void
    {
        $itemInternalId = ItemModel::where('public_id', $consumption->getItemId())->value('id')
            ?? throw new InfrastructureException(sprintf('Item with id %s not found', $consumption->getItemId()));
        ConsumptionModel::updateOrCreate(
            ['public_id' => $consumption->getId()],
            [
                'item_id' => $itemInternalId,
                'amount' => $consumption->getAmount(),
                'consumed_at' => $consumption->getConsumedAt(),
            ]
        );
    }

    public function countConsumesByItemId(string $itemId): int
    {
        return ConsumptionModel::whereHas('item', fn($q) => $q->where('public_id', $itemId))->count();
    }
}