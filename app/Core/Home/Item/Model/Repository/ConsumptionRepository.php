<?php

namespace App\Core\Home\Item\Model\Repository;

use App\Core\Home\Item\Model\Consumption;

interface ConsumptionRepository
{
    public function consume(Consumption $consumption): void;

    public function amountOfConsumesByItemId(string $itemId): float;
}