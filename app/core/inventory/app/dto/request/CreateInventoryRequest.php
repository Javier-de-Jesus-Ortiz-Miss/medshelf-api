<?php

namespace App\core\inventory\app\dto\request;

readonly class CreateInventoryRequest
{
    public function __construct(
        public string $ownerId,
        public string $name
    )
    {
    }
}
