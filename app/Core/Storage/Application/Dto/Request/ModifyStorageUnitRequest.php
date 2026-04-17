<?php

namespace App\Core\Storage\Application\Dto\Request;

readonly class ModifyStorageUnitRequest
{
    public function __construct(
        public string  $houseId,
        public ?string $name
    )
    {
    }
}
