<?php

namespace App\Core\Catalog\Product\Application\UseCase;

use App\Core\Catalog\Product\Application\Dto\Request\AddProductRequest;
use App\Core\Catalog\Product\Application\Dto\Response\ProductResponse;
use App\Core\Catalog\Product\Application\Mapping\ProductMapper;
use App\Core\Catalog\Product\Model\Repository\ProductRepository;
use App\Core\Catalog\Product\Model\Service\ProductCreator;
use App\Core\Catalog\Product\Model\ValueObject\ActiveIngredient;
use App\Core\Catalog\Product\Model\ValueObject\Composition;
use App\Core\Catalog\Product\Model\ValueObject\ConsumptionType;
use App\Core\Catalog\Product\Model\ValueObject\NetContent;
use App\Core\Catalog\Product\Model\ValueObject\PharmaceuticalForm;
use App\Core\Catalog\Product\Model\ValueObject\Strength;
use App\Core\Shared\Domain\UnitFactory;
use InvalidArgumentException;

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
            function (ActiveIngredient $ingredient) {
                if (!$this->repository->existsActiveIngredient($ingredient->name)) {
                    throw new InvalidArgumentException("Active ingredient '{$ingredient->name}' does not exist.");
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

        $pharmaceuticalForm = new PharmaceuticalForm(
            name: $request->pharmaceuticalForm->name,
            consumptionType: ConsumptionType::from(strtolower($request->pharmaceuticalForm->consumptionType))
        );

        $netContent = $request->netContent
            ? new NetContent(
                value: $request->netContent->value,
                unit: UnitFactory::create($request->netContent->unit)
            )
            : null;

        $product = ProductCreator::create(
            name: $request->name,
            netContent: $netContent,
            quantity: $request->totalQuantity,
            pharmaceuticalForm: $pharmaceuticalForm,
            composition: $composition,
        );

        $this->repository->save($product);
        return ProductMapper::toResponse($product);
    }
}
