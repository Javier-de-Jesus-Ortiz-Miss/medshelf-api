<?php

namespace App\Core\Home\Item\Model;

use App\Core\Shared\Domain\Utils;
use Carbon\Carbon;

final class Item
{
    private function __construct(
        protected string $id,
        protected string $productId,
        protected string $storageId,
        protected float  $totalContent,
        protected Carbon $expirationDate,
        protected Carbon $createdAt
    )
    {
    }

    public static function load(
        string $id,
        string $productId,
        string $storageId,
        float  $totalContent,
        Carbon $expirationDate,
        Carbon $createdAt
    ): Item
    {
        return new self(
            $id,
            $productId,
            $storageId,
            $totalContent,
            $expirationDate,
            $createdAt
        );
    }

    public static function create(
        string $productId,
        string $storageUnitId,
        float  $totalContent,
        Carbon $expirationDate
    ): Item
    {
        return new self(
            Utils::generateUUIDV4(),
            $productId,
            $storageUnitId,
            $totalContent,
            $expirationDate,
            Carbon::now()
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

    public function getStorageId(): string
    {
        return $this->storageId;
    }

    public function getTotalContent(): int
    {
        return $this->totalContent;
    }

    public function getExpirationDate(): Carbon
    {
        return $this->expirationDate;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }
}
