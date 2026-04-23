<?php

namespace App\Core\Item\Application\Dto\Data;

readonly class StorageUnitResume
{
    public function __construct(
        public string $id,
        public string $placeId,
        public string $name
    )
    {
    }
}
