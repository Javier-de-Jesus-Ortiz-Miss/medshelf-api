<?php

namespace App\Providers\item;

use App\core\item\model\Item;
use App\core\item\model\ItemRepository;
use App\Providers\mocks\ItemStorage;

class ItemRepositoryAdapter implements ItemRepository
{
    public function findById(string $id): ?Item
    {
        return ItemStorage::$storage[$id] ?? null;
    }

    public function save(Item $inventoryItem): void
    {
        ItemStorage::$storage[$inventoryItem->getId()] = $inventoryItem;
    }

    public function deleteById(string $id): void
    {
        unset(ItemStorage::$storage[$id]);
    }

    public function exists(string $id): bool
    {
        return isset(ItemStorage::$storage[$id]);
    }
}
