<?php

namespace App\Core\Item\Application\Dto\Data;

readonly class PlaceResume
{
    public function __construct(
        public string $id,
        public string $houseId,
        public string $name,
    )
    {
    }
}
