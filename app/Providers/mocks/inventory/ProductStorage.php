<?php

namespace App\Providers\mocks\inventory;

use App\core\inventory\model\Medicine;
use App\core\inventory\model\PackageProduct;
use App\core\inventory\model\Presentation;
use App\core\inventory\model\ProductStatus;
use App\core\inventory\model\Substance;
use DateTime;

class ProductStorage
{
    public static array $storage = [];

    public static function persist(): void
    {
        // Serializar objetos a arrays antes de guardar
        $serialized = array_map(self::serializeProduct(...), self::$storage);
        file_put_contents(storage_path('products.json'), json_encode($serialized, JSON_PRETTY_PRINT));
    }

    private static function serializeProduct(PackageProduct $product): array
    {
        return [
            'id' => $product->id,
            'brandName' => $product->medicine->brandName,
            'substances' => array_map(
                fn(Substance $s) => $s->name,
                $product->substances()->toArray()
            ),
            'shape' => $product->presentation->shape,
            'totalAmount' => $product->presentation->totalAmount,
            'unit' => $product->presentation->unit,
            'quantity' => $product->quantity(),
            'expirationDate' => $product->expirationDate->format('Y-m-d'),
            'status' => $product->status()->name,
            'addedDate' => $product->addedDate()->format('Y-m-d H:i:s'),
        ];
    }

    private static function deserializeProduct(array $data): PackageProduct
    {
        $substances = array_map(
            fn(string $name) => Substance::create($name),
            $data['substances']
        );

        return PackageProduct::load(
            $data['id'],
            Medicine::create($data['brandName']),
            $substances,
            Presentation::create($data['shape'], $data['totalAmount'], $data['unit']),
            $data['quantity'],
            new DateTime($data['expirationDate']),
            ProductStatus::from($data['status']),
            new DateTime($data['addedDate'])
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
