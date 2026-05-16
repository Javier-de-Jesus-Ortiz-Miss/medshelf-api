<?php

namespace App\Core\Home\Profile\Application\Dto\Response;

readonly class ProfileResponse
{
    public function __construct(
        public string  $id,
        public string  $name,
        public ?string $relationship,
        public string  $createdAt,
    )
    {
    }
}
