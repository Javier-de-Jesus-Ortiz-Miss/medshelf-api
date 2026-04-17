<?php

namespace App\Core\Item\Application\Port;

interface DeleteItem
{
    public function execute(string $itemId): void;
}
