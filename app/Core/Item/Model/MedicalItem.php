<?php

namespace App\Core\Item\Model;

use App\Core\Shared\Domain\Utils;
use Carbon\Carbon;
use InvalidArgumentException;

final class MedicalItem
{
    private const int SOON_TO_EXPIRE_DAYS = 3;

    private function __construct(
        private string $id,
        private string $medicalProductId,
        private string $storageUnitId,
        private int    $totalQuantity,
        private int    $availableQuantity,
        private Carbon $expirationDate,
        private Carbon $addedDate
    )
    {
    }

    public static function create(
        string $productId,
        string $inventoryId,
        int    $totalQuantity,
        Carbon $expirationDate
    ): MedicalItem
    {
        return new self(
            Utils::generateUUIDV4(),
            $productId,
            $inventoryId,
            $totalQuantity,
            $totalQuantity,
            $expirationDate,
            Carbon::now()
        );
    }

    public static function load(
        string $id,
        string $productId,
        string $inventoryId,
        int    $totalQuantity,
        int    $quantity,
        Carbon $expirationDate,
        Carbon $addedDate
    ): MedicalItem
    {
        return new self(
            $id,
            $productId,
            $inventoryId,
            $totalQuantity,
            $quantity,
            $expirationDate,
            $addedDate
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMedicalProductId(): string
    {
        return $this->medicalProductId;
    }

    public function getStorageUnitId(): string
    {
        return $this->storageUnitId;
    }

    public function getTotalQuantity(): int
    {
        return $this->totalQuantity;
    }

    public function getAvailableQuantity(): int
    {
        return $this->availableQuantity;
    }

    public function getExpirationDate(): Carbon
    {
        return $this->expirationDate;
    }

    public function getAddedDate(): Carbon
    {
        return $this->addedDate;
    }

    public function consume(int $quantity = 1): void
    {
        if ($quantity > $this->availableQuantity) {
            throw new InvalidArgumentException('Not enough quantity in item item.');
        }
        $this->availableQuantity -= $quantity;
    }

    public function isEmpty(): bool
    {
        return $this->availableQuantity === 0;
    }

    public function isExpired(): bool
    {
        return $this->expirationDate->isPast();
    }

    public function isSoonToExpire(): bool
    {
        return $this->expirationDate->diffInDays(Carbon::now()) <= self::SOON_TO_EXPIRE_DAYS;
    }
}
