<?php

namespace App\core\inventory\app\service;

use App\core\inventory\app\dto\request\AddProductRequest;
use App\core\inventory\app\dto\response\ProductResponse;
use App\core\inventory\app\mapping\PackageProductMapper;
use App\core\inventory\app\port\AddProduct;
use App\core\inventory\model\Medicine;
use App\core\inventory\model\PackageProduct;
use App\core\inventory\model\PackageProductRepository;
use App\core\inventory\model\Presentation;
use App\core\inventory\model\Substance;

readonly class AddProductService implements AddProduct
{
    public function __construct(
        private PackageProductRepository $repository
    )
    {
    }

    public function execute(AddProductRequest $request): ProductResponse
    {
        $substances = array_map(
            static fn(string $substance): Substance => Substance::create($substance),
            $request->substances
        );
        $newProduct = PackageProduct::create(
            Medicine::create($request->brandName),
            Presentation::create($request->shape, $request->totalAmount, $request->unit),
            $request->expirationDate,
            ...$substances
        );
        $this->repository->save($newProduct);
        return PackageProductMapper::toResponse($newProduct);
    }
}
