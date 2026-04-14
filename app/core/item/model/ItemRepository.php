<?php

namespace App\core\item\model;

interface ItemRepository
{
    public function findById(string $id): ?Item;

    public function save(Item $inventoryItem): void;

    public function deleteById(string $id): void;

    public function exists(string $id): bool;
}
