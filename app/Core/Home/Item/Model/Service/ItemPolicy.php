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
        if ($amount <= 0) {
            throw ConsumptionException::invalidAmount();
        }
        $consumptionsCount = $this->consumptionRepository->amountOfConsumesByItemId($item->getId());
        if ($productResume->consumptionType == ConsumptionType::DISCRETE && floor($amount) != $amount) {
            throw ConsumptionException::invalidAmountForDiscreteConsumptionType($item->getId());
        }
        if ($item->getTotalContent() - $consumptionsCount < $amount) {
            throw ConsumptionException::consumptionExceedsAvailableContent($item->getId());
        }
    }
}