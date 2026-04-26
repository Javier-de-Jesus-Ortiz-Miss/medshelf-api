<?php

namespace App\Core\Product\Application\Service;

use App\Core\Product\Application\Dto\Request\AddMedicalProductRequest;
use App\Core\Product\Application\Dto\Response\MedicalProductResponse;
use App\Core\Product\Application\Mapping\MedicalProductMapper;
use App\Core\Product\Model\Concentration;
use App\Core\Product\Model\MedicalProduct;
use App\Core\Product\Model\MedicalProductRepository;
use App\Core\Product\Model\PresentationType;

final readonly class AddMedicalProduct
{
    public function __construct(
        private MedicalProductRepository $repository
    )
    {
    }

    function execute(AddMedicalProductRequest $request): MedicalProductResponse
    {
        $presentationType = new PresentationType($request->presentationType);
        $concentration = new Concentration(
            unit: $request->concentrationUnit,
            value: $request->concentrationValue
        );
        $product = MedicalProduct::create(
            name: $request->name,
            description: $request->description,
            presentationType: $presentationType,
            concentration: $concentration
        );
        $this->repository->save($product);
        return MedicalProductMapper::toProductResponse($product);
    }
}
