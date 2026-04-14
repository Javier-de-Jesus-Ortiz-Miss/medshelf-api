<?php

namespace App\Providers\mocks;

use App\core\item\model\Item;
use Carbon\Carbon;
use DateTimeInterface;

class ItemStorage
{
    public static array $storage = [];

    public static function persist(): void
    {
        // Serializar objetos a arrays antes de guardar
        $serialized = array_map(self::serializeProduct(...), self::$storage);
        file_put_contents(storage_path('products.json'), json_encode($serialized, JSON_PRETTY_PRINT));
    }

    private static function serializeProduct(Item $item): array
    {
        return [
            'id' => $item->getId(),
            'productId' => $item->getProductId(),
            'inventoryId' => $item->getInventoryId(),
            'totalQuantity' => $item->getTotalQuantity(),
            'quantity' => $item->getQuantity(),
            'expirationDate' => $item->getExpirationDate()->format(DateTimeInterface::ATOM),
            'addedDate' => $item->getAddedDate()->format(DateTimeInterface::ATOM),
        ];
    }

    private static function deserializeProduct(array $data): Item
    {
        return Item::load(
            $data['id'],
            $data['productId'],
            $data['inventoryId'],
            $data['totalQuantity'],
            $data['quantity'],
            new Carbon($data['expirationDate']),
            new Carbon($data['addedDate'])
        );
    }

    public static function load(): void
    {
        if (file_exists(storage_path('products.json'))) {
            $data = json_decode(file_get_contents(storage_path('products.json')), true) ?? [];
            // Deserializar de arrays a objetos PackageProduct
            self::$storage = array_map(self::deserializeProduct(...), $data);
        } else {
            self::$storage = [];
        }
    }
}
