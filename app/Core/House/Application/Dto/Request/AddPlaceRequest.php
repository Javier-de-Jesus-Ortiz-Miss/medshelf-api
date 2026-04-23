<?php

namespace App\Core\House\Application\Dto\Request;

readonly class AddPlaceRequest
{
    public function __construct(
        public string $houseId,
        public string $name
    )
    {
    }
}
