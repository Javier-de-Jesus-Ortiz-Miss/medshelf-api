<?php

namespace App\Core\Storage\Application\Dto\Response;

readonly class StorageUnitResponse
{
    public function __construct(
        public string $id,
        public string $houseId,
        public string $name
    )
    {
    }
}
