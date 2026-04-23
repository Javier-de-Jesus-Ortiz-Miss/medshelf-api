<?php

namespace App\Core\Item\Model;

use App\Core\Shared\Domain\Utils;
use Carbon\Carbon;
use InvalidArgumentException;

final class MedicalItem
{
    private const int SOON_TO_EXPIRE_DAYS = 3;

    private function __construct(
        protected string $id,
        protected string $medicalProductId,
        protected string $storageUnitId,
        protected int    $totalQuantity,
        /** @var Consumption[] */
        protected array  $consumptions,
        protected Carbon $expirationDate,
        protected Carbon $addedDate
    )
    {
    }

    public static function load(
        string $id,
        string $productId,
        string $storageUnitId,
        int    $totalQuantity,
        array  $consumptions,
        Carbon $expirationDate,
        Carbon $addedDate
    ): MedicalItem
    {
        return new self(
            $id,
            $productId,
            $storageUnitId,
            $totalQuantity,
            $consumptions,
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

    /**
     * @return Consumption[]
     */
    public function getConsumptions(): array
    {
        return $this->consumptions;
    }

    public function getExpirationDate(): Carbon
    {
        return $this->expirationDate;
    }

    public function getAddedDate(): Carbon
    {
        return $this->addedDate;
    }

    public function consume(int $quantity = 1): Consumption
    {
        if ($quantity > $this->getAvailableQuantity()) {
            throw new InvalidArgumentException('Not enough quantity in item item.');
        }
        $consumption = Consumption::create($this->id, $quantity);
        $this->consumptions[] = $consumption;

        return $consumption;
    }

    public function getAvailableQuantity(): int
    {
        $consumed = array_sum(
            array_map(fn(Consumption $c) => $c->getAmount(), $this->consumptions)
        );
        return $this->totalQuantity - $consumed;
    }

    public static function create(
        string $productId,
        string $storageUnitId,
        int    $totalQuantity,
        Carbon $expirationDate
    ): MedicalItem
    {
        return new self(
            Utils::generateUUIDV4(),
            $productId,
            $storageUnitId,
            $totalQuantity,
            [],
            $expirationDate,
            Carbon::now()
        );
    }

    public function isEmpty(): bool
    {
        return $this->getAvailableQuantity() === 0;
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
