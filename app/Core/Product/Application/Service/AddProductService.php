<?php

namespace App\Core\Product\Application\Service;

use App\Core\Product\Application\Dto\Request\AddProductRequest;
use App\Core\Product\Application\Dto\Response\ProductResponse;
use App\Core\Product\Application\Mapping\ProductMapper;
use App\Core\Product\Application\Port\AddProduct;
use App\Core\Product\Model\Concentration;
use App\Core\Product\Model\PresentationType;
use App\Core\Product\Model\Product;
use App\Core\Product\Model\ProductRepository;

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
            unit: $request->concentrationUnit,
            value: $request->concentrationValue
        );
        $product = Product::create(
            name: $request->name,
            description: $request->description,
            presentationType: $presentationType,
            concentration: $concentration
        );
        $this->repository->save($product);
        return ProductMapper::toProductResponse($product);
    }
}
