<?php

namespace App\Core\Storage\Application\Port;

interface DeleteStorageUnit
{
    public function execute(string $storageUnitId): void;
}

