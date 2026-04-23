<?php

namespace App\Core\Item\Application\Dto\Request;

readonly class ConsumeMedicalItemRequest
{
    public function __construct(
        public string $medicalItemId,
        public int    $amount,
    )
    {
    }
}
