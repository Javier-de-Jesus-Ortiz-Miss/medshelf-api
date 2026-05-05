<?php

namespace App\Core\Home\Item\Model\Exception;

use App\Core\Shared\Domain\DomainException;

class ConsumptionException extends DomainException
{

    public static function itemNotFound(string $itemId): self
    {
        return new self("Item not found with id $itemId");
    }

    public static function productNotFound(string $productId): self
    {
        return new self("Product not found with id $productId");
    }

    public static function invalidAmountForUnitaryConsumptionType(string $itemId): self
    {
        return new self("Invalid amount for unitary consumption type for item with id $itemId");
    }

    public static function consumptionExceedsTotalQuantity(string $itemId): self
    {
        return new self("Consumption exceeds total quantity for item with id $itemId");
    }
}