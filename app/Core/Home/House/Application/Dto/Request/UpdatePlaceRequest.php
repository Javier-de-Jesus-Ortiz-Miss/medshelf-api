<?php

namespace App\Core\Home\House\Application\Dto\Request;

readonly class UpdatePlaceRequest
{
    public function __construct(
        public string $placeId,
        public string $name,
        public string $houseId,
    )
    {
    }
}
