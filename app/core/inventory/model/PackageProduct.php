<?php

namespace App\core\inventory\model;

use App\core\shared\domain\ImmutableArray;
use App\core\shared\domain\Utils;
use DateTime;
use Nette\InvalidStateException;

final class PackageProduct
{
    private function __construct(
        public readonly string       $id,
        public readonly Medicine     $medicine,
        private readonly array       $substances,
        public readonly Presentation $presentation,
        private int                  $quantity,
        public readonly DateTime     $expirationDate,
        private ProductStatus        $status,
        public readonly DateTime     $addedDate,
    )
    {
    }

    public static function create(
        Medicine     $medicine,
        Presentation $presentation,
        DateTime     $expirationDate,
        Substance    ...$substances,
    ): PackageProduct
    {
        return new self(
            Utils::generateUUIDV4(),
            $medicine,
            $substances,
            $presentation,
            $presentation->totalAmount,
            $expirationDate,
            ProductStatus::OK,
            new DateTime()
        );
    }

    public static function load(
        string        $id,
        Medicine      $medicine,
        array         $substances,
        Presentation  $presentation,
        int           $quantity,
        DateTime      $expirationDate,
        ProductStatus $status,
        DateTime      $addedDate
    ): PackageProduct
    {
        return new self(
            $id,
            $medicine,
            $substances,
            $presentation,
            $quantity,
            $expirationDate,
            $status,
            $addedDate
        );
    }

    public function substances(): ImmutableArray
    {
        return new ImmutableArray($this->substances);
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function status(): ProductStatus
    {
        return $this->status;
    }

    public function addedDate(): DateTime
    {
        return $this->addedDate;
    }

    public function isExpired(): bool
    {
        if ($this->expirationDate < new DateTime()) {
            return false;
        }
        $this->status = ProductStatus::EXPIRED;
        return true;
    }

    public function consume(int $amount = 1): void
    {
        if ($this->status === ProductStatus::EXPIRED) {
            throw new InvalidStateException("Cannot consume an expired product.");
        }
        if ($amount < 1) {
            throw new InvalidStateException("Amount must be greater than 0.");
        }
        if ($this->quantity < $amount) {
            throw new InvalidStateException("Not enough quantity to consume.");
        }
        $actualQuantity = $this->quantity;
        $finalQuantity = $actualQuantity - $amount;
        if ($finalQuantity === 0) {
            $this->status = ProductStatus::CONSUMED;
        }
        $this->quantity = $finalQuantity;
    }
}
