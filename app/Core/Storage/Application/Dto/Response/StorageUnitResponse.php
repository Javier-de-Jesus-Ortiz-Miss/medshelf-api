<?php

namespace App\Core\Storage\Application\Dto\Response;

use Carbon\Carbon;

readonly class StorageUnitResponse
{
    public function __construct(
        public string $id,
        public string $placeId,
        public string $name,
        public Carbon $createdAt
    )
    {
    }
}
