<?php

namespace App\Core\House\Application\Dto\Data;

readonly class OwnerResume
{
    public function __construct(
        public string $id,
        public string $firstName,
        public string $lastName
    )
    {
    }
}
