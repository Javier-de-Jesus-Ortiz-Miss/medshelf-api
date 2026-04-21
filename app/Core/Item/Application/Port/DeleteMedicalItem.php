<?php

namespace App\Core\Item\Application\Port;

interface DeleteMedicalItem
{
    public function execute(string $itemId): void;
}
