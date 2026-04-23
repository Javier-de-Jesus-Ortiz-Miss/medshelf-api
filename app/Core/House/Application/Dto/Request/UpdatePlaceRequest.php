<?php

namespace App\Core\House\Application\Dto\Request;

readonly class UpdatePlaceRequest
{
    public function __construct(
        public string $id,
        public string $name
    )
    {
    }
}
