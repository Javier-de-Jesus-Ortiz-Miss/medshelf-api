<?php

namespace App\core\item\app\port;

interface DeleteItem
{
    public function execute(string $itemId): void;
}
