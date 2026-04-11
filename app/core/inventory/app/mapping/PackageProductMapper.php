<?php

namespace App\core\inventory\app\mapping;

use App\core\inventory\app\dto\response\ProductResponse;
use App\core\inventory\model\PackageProduct;
use App\core\inventory\model\Substance;
use DateTimeInterface;

class PackageProductMapper
{
    public static function toResponse(PackageProduct $packageProduct): ProductResponse {
        $substances = array_map(
            static fn (Substance $substance): string => $substance->name,
            $packageProduct->substances()->toArray()
        );

        return new ProductResponse(
            $packageProduct->id,
            $packageProduct->medicine->brandName,
            $substances,
            $packageProduct->presentation->shape,
            $packageProduct->presentation->totalAmount,
            $packageProduct->presentation->unit,
            $packageProduct->quantity(),
            $packageProduct->expirationDate->format(DateTimeInterface::ATOM),
            $packageProduct->status()->name,
            $packageProduct->addedDate()->format(DateTimeInterface::ATOM)
        );
    }
}
