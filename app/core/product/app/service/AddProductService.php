<?php

namespace App\core\product\app\service;

use App\core\product\app\dto\request\AddProductRequest;
use App\core\product\app\dto\response\ProductResponse;
use App\core\product\app\mapping\ProductMapper;
use App\core\product\app\port\AddProduct;
use App\core\product\model\Concentration;
use App\core\product\model\PresentationType;
use App\core\product\model\Product;
use App\core\product\model\ProductRepository;

final readonly class AddProductService implements AddProduct
{
    public function __construct(
        private ProductRepository $repository
    )
    {
    }

    function execute(AddProductRequest $request): ProductResponse
    {
        $presentationType = new PresentationType($request->presentationType);
        $concentration = new Concentration(
            $request->concentrationAmount,
            $request->concentrationUnit
        );
        $product = Product::create(
            $request->name,
            $request->description,
            $presentationType,
            $concentration
        );
        $this->repository->save($product);
        return ProductMapper::toProductResponse($product);
    }
}
