<?php

namespace App\Core\Storage\Application\Dto\Request;

readonly class CreateStorageUnitRequest
{
    public function __construct(
        public string $houseId,
        public string $name
    )
    {
    }
}
