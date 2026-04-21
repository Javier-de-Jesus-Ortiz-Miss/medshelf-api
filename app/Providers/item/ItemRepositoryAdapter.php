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

    public function save(Item $item): void
    {
        ItemStorage::$storage[$item->getId()] = $item;
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
