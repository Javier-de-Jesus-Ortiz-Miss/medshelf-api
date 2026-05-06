<?php

namespace App\Core\Home\House\Application\Dto\Request;

readonly class RemovePlaceRequest
{
    public function __construct(
        public string $placeId,
        public string $houseId,
    )
    {
    }
}
