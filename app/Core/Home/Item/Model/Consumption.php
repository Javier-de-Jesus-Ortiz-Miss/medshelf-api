<?php

namespace App\Core\Home\Item\Model;

use App\Core\Home\Item\Model\Event\ItemConsumed;
use App\Core\Shared\Domain\DomainEvent;
use App\Core\Shared\Domain\Utils;
use Carbon\Carbon;

final class Consumption
{

    /* @var array<int, DomainEvent> */
    private array $events = [];

    private function __construct(
        protected string $id,
        protected string $itemId,
        protected int    $amount,
        protected Carbon $consumedAt
    )
    {
    }

    public static function create(string $itemId, int $amount): Consumption
    {
        $consumption = new self(
            Utils::generateUUIDV4(),
            $itemId,
            $amount,
            Carbon::now()
        );
        $consumption->addEvent(
            new ItemConsumed(
                itemId: $itemId,
                amount: $amount
            )
        );
        return $consumption;
    }

    public function addEvent(DomainEvent $event): void
    {
        $this->events[] = $event;
    }

    public static function load(string $id, string $itemId, int $amount, Carbon $consumedAt): Consumption
    {
        return new self(
            $id,
            $itemId,
            $amount,
            $consumedAt
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getItemId(): string
    {
        return $this->itemId;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getConsumedAt(): Carbon
    {
        return $this->consumedAt;
    }

    /**
     * @return array<int, DomainEvent>
     */
    public function pullEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }
}
