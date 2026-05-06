<?php

namespace App\Providers\Core\Home\Item\Service;

use App\Core\Shared\Application\EventPublisher;
use App\Models\ItemModel;
use App\Providers\Core\Home\Item\Event\ItemExpiringSoon;

final readonly class CheckExpiringItems
{
    public function __construct(
        private EventPublisher $eventPublisher
    )
    {
    }

    public function execute(): void
    {
        $expiringItems = ItemModel::with(['storage.place.house' => fn($q) => $q->select('id', 'public_id')])
            ->where('expiration_date', '<=', now()->addDays(7))
            ->get();
        $expiringItems->each(function ($item) {
            $this->eventPublisher->publish(new ItemExpiringSoon(
                    $item->storage->place->house->public_id,
                    $item->public_id,
                    $item->expiration_date)
            );
        });
    }
}