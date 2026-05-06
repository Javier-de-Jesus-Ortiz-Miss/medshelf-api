<?php

namespace App\Core\Catalog\Product\Application\UseCase;

use App\Core\Catalog\Product\Application\Dto\Request\ActiveIngredientRequest;
use App\Core\Catalog\Product\Application\Dto\Request\AddProductRequest;
use App\Core\Catalog\Product\Application\Dto\Response\ProductResponse;
use App\Core\Catalog\Product\Application\Exception\ActiveIngredientNotFound;
use App\Core\Catalog\Product\Application\Exception\PharmaceuticalFormNotFound;
use App\Core\Catalog\Product\Application\Mapping\ProductMapper;
use App\Core\Catalog\Product\Model\Repository\ProductRepository;
use App\Core\Catalog\Product\Model\Service\ProductCreator;
use App\Core\Catalog\Product\Model\ValueObject\ActiveIngredient;
use App\Core\Catalog\Product\Model\ValueObject\Composition;
use App\Core\Catalog\Product\Model\ValueObject\NetContent;
use App\Core\Catalog\Product\Model\ValueObject\Strength;
use App\Core\Shared\Domain\UnitFactory;

final readonly class AddProduct
{
    public function __construct(
        private ProductRepository $repository,
    )
    {
    }

    function execute(AddProductRequest $request): ProductResponse
    {
        $activeIngredients = array_map(
            function (ActiveIngredientRequest $ingredient) {
                if (!$this->repository->existsActiveIngredient($ingredient->name)) {
                    throw new ActiveIngredientNotFound($ingredient->name);
                }
                return new ActiveIngredient(
                    name: $ingredient->name,
                    strength: new Strength(
                        value: $ingredient->strength->value,
                        unit: UnitFactory::create($ingredient->strength->unit)
                    )
                );
            },
            $request->composition->activeIngredients
        );

        $composition = new Composition(
            referenceAmount: $request->composition->referenceAmount,
            activeIngredients: $activeIngredients
        );
        $pharmaceuticalForm = $this->repository->findPharmaceuticalFormByName($request->pharmaceuticalForm)
            ?? throw new PharmaceuticalFormNotFound($request->pharmaceuticalForm);

        $netContent = $request->netContent
            ? new NetContent(
                value: $request->netContent->value,
                unit: UnitFactory::create($request->netContent->unit)
            )
            : null;

        $product = ProductCreator::create(
            name: $request->name,
            netContent: $netContent,
            totalQuantity: $request->totalQuantity,
            pharmaceuticalForm: $pharmaceuticalForm,
            composition: $composition,
        );

        $this->repository->save($product);
        return ProductMapper::toResponse($product);
    }
}
