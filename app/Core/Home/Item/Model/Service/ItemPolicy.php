<?php

namespace App\Core\Home\Item\Model\Service;

use App\Core\Home\Item\Model\Exception\ConsumptionException;
use App\Core\Home\Item\Model\Item;
use App\Core\Home\Item\Model\Product;
use App\Core\Home\Item\Model\Repository\ConsumptionRepository;
use App\Core\Home\Item\Model\ValueObject\ConsumptionType;

final readonly class ItemPolicy
{
    public function __construct(
        private ConsumptionRepository $consumptionRepository,
    )
    {
    }

    public function assertConsumption(Item $item, float $amount, Product $productResume): void
    {
        $consumptionsCount = $this->consumptionRepository->countConsumesByItemId($item->getId());
        if ($productResume->consumptionType == ConsumptionType::UNITARY && floor($amount) != $amount) {
            throw ConsumptionException::invalidAmountForUnitaryConsumptionType($item->getId());
        }
        if ($consumptionsCount + $amount > $item->getTotalContent()) {
            throw ConsumptionException::consumptionExceedsTotalQuantity($item->getId());
        }
    }
}