<?php

namespace App\Core\House\Application\Dto\Request;

readonly class ModifyPlacesRequest
{
    public function __construct(
        public string            $ownerId,
        public array|string|null $placesNames
    )
    {

    }
}
