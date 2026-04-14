<?php

namespace App\core\inventory\model;

interface InventoryRepository
{
    public function findById(string $id): ?Inventory;

    public function findByOwnerId(string $ownerId): ?Inventory;

    public function save(Inventory $inventory): void;

    public function deleteById(string $id): void;
}
