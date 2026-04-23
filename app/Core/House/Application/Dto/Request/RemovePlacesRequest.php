<?php

namespace App\Core\House\Application\Dto\Request;

readonly class RemovePlacesRequest
{
    public function __construct(
        public string $houseId,
        public array  $placeIds
    )
    {
    }
}
