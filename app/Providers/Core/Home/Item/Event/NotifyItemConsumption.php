<?php

namespace App\Providers\Core\Home\Item\Event;

use App\Core\Home\Item\Model\Event\ItemConsumed;
use Log;

class NotifyItemConsumption
{
    public function handle(ItemConsumed $event): void
    {
        Log::info(sprintf(
            'Item %s consumed, amount: %s',
            $event->itemId,
            $event->amount
        ));
        // Here you can add additional logic to notify users, update inventory, etc.
    }
}