<?php

namespace App\core\item\app\dto\data;

readonly class InventoryResume
{
    public function __construct(
        public string $id,
        public string $name
    )
    {
    }
}
