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

    public static function invalidAmountForDiscreteConsumptionType(string $itemId): self
    {
        return new self("Invalid amount for discrete consumption type for item with id $itemId");
    }

    public static function consumptionExceedsAvailableContent(string $itemId): self
    {
        return new self("Consumption exceeds available content for item with id $itemId");
    }

    public static function invalidAmount(): self
    {
        return new self("Invalid amount for consumption");
    }
}