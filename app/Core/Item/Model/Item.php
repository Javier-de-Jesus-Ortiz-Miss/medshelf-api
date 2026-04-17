<?php

namespace App\Core\Item\Model;

use App\Core\Shared\Domain\Utils;
use Carbon\Carbon;
use InvalidArgumentException;

final class Item
{
    private const int SOON_TO_EXPIRE_DAYS = 3;

    private function __construct(
        private string $id,
        private string $productId,
        private string $inventoryId,
        private int    $totalQuantity,
        private int    $quantity,
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
    ): Item
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
    ): Item
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

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getInventoryId(): string
    {
        return $this->inventoryId;
    }

    public function getTotalQuantity(): int
    {
        return $this->totalQuantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
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
        if ($quantity > $this->quantity) {
            throw new InvalidArgumentException('Not enough quantity in item item.');
        }
        $this->quantity -= $quantity;
    }

    public function isEmpty(): bool
    {
        return $this->quantity === 0;
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
