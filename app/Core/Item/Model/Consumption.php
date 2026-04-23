<?php

namespace App\Core\Item\Model;

use App\Core\Shared\Domain\Utils;
use Carbon\Carbon;

final class Consumption
{
    private function __construct(
        protected string $id,
        protected string $medicalItemId,
        protected int    $amount,
        protected Carbon $consumptionDate
    )
    {
    }

    public static function create(string $itemId, int $quantity): Consumption
    {
        return new self(
            Utils::generateUUIDV4(),
            $itemId,
            $quantity,
            Carbon::now()
        );
    }

    public static function load(string $id, string $itemId, int $quantity, Carbon $consumptionAt): Consumption
    {
        return new self(
            $id,
            $itemId,
            $quantity,
            $consumptionAt
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMedicalItemId(): string
    {
        return $this->medicalItemId;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getConsumptionDate(): Carbon
    {
        return $this->consumptionDate;
    }
}
