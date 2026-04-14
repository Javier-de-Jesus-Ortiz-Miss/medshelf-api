<?php

namespace App\core\inventory\app\dto\request;

readonly class ModifyInventoryRequest
{
    public function __construct(
        public string  $ownerId,
        public ?string $name
    )
    {
    }
}
