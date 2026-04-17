<?php

namespace App\Core\House\Application\Dto\Request;

readonly class CreateHouseRequest
{
    public function __construct(
        public string $ownerId,
        public string $name
    )
    {
    }
}
