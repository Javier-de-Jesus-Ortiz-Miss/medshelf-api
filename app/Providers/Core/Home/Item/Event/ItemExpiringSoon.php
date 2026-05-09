<?php

namespace App\Providers\Core\Home\Item\Event;

readonly class ItemExpiringSoon
{
    public function __construct(
        public string $houseId,
        public string $itemId,
        public string $expirationDate
    )
    {
    }

}