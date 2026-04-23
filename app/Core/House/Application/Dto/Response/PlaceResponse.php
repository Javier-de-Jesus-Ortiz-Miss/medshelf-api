<?php

namespace App\Core\House\Application\Dto\Response;

readonly class PlaceResponse
{
    public function __construct(
        public string $id,
        public string $houseId,
        public string $name
    )
    {
    }
}
