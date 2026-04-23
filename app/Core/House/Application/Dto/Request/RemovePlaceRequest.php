<?php

namespace App\Core\House\Application\Dto\Request;

readonly class RemovePlaceRequest
{
    public function __construct(
        public string $id
    )
    {
    }
}
