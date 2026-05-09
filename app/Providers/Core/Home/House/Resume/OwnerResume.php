<?php

namespace App\Providers\Core\Home\House\Resume;

readonly class OwnerResume
{
    public function __construct(
        public string $id,
        public string $name,
    )
    {
    }
}