<?php

namespace App\Providers\Core\Catalog\Product\Service;

use App\Core\Catalog\Product\Model\Product;
use App\Core\Catalog\Product\Model\Repository\ProductRepository;
use App\Core\Catalog\Product\Model\ValueObject\ActiveIngredient;
use App\Core\Catalog\Product\Model\ValueObject\Composition;
use App\Core\Catalog\Product\Model\ValueObject\ConsumptionType;
use App\Core\Catalog\Product\Model\ValueObject\NetContent;
use App\Core\Catalog\Product\Model\ValueObject\PharmaceuticalForm;
use App\Core\Catalog\Product\Model\ValueObject\Strength;
use App\Models\ActiveCompoundModel;
use App\Models\ProductCompoundModel;
use App\Models\ProductModel;
use App\Providers\Core\InfrastructureException;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductRepositoryAdapter implements ProductRepository
{

    public function findById(string $id): ?Product
    {
        $record = ProductModel::with([
            'activeCompounds',
            'activeCompounds.activeCompound',
        ])
            ->where('public_id', $id)
            ->first();
        if (!$record) return null;
        return $this->toDomain($record);
    }

    private function toDomain(ProductModel $productModel): Product
    {
        $activeCompounds = $productModel->activeCompounds;
        return Product::load(
            id: $productModel->public_id,
            name: $productModel->name,
            netContent: ($productModel->net_content_value && $productModel->net_content_unit)
                ? new NetContent(
                    value: $productModel->net_content_value,
                    unit: $productModel->net_content_unit,
                )
                : null,
            totalQuantity: $productModel->total_quantity,
            pharmaceuticalForm: new PharmaceuticalForm(
                name: $productModel->pharmaceutical_form_name,
                consumptionType: ConsumptionType::from($productModel->pharmaceutical_form_consumption_type),
            ),
            createdAt: $productModel->created_at,
            composition: new Composition(
                referenceAmount: $productModel->composition_reference_amount,
                activeIngredients: $activeCompounds
                    ->map(
                        fn(ProductCompoundModel $compound) => new ActiveIngredient(
                            name: $compound->activeCompound->name,
                            strength: new Strength(
                                value: $compound->strength_value,
                                unit: $compound->strength_unit,
                            )
                        )
                    )->toArray(),
            ),
        );
    }

    public function save(Product $product): void
    {
        try {
            DB::transaction(function () use ($product) {
                $productSaved = ProductModel::updateOrCreate(
                    ['public_id' => $product->getId()],
                    [
                        'name' => $product->getName(),
                        'net_content_value' => $product->getNetContent()?->value,
                        'net_content_unit' => $product->getNetContent()?->unit,
                        'total_quantity' => $product->getTotalQuantity(),
                        'pharmaceutical_form_name' => $product->getPharmaceuticalForm()->name,
                        'pharmaceutical_form_consumption_type' => $product->getPharmaceuticalForm()->consumptionType->value,
                        'composition_reference_amount' => $product->getComposition()->referenceAmount
                    ]
                );
                $productSaved->activeCompounds()->delete();
                foreach ($product->getComposition()->activeIngredients as $ingredient) {
                    $compound = ActiveCompoundModel::where('name', $ingredient->name)->first();

                    if (!$compound) {
                        throw new InfrastructureException("Active compound not found: " . $ingredient->name);
                    }

                    $productSaved->activeCompounds()->create([
                        'active_compound_id' => $compound->id,
                        'strength_value' => $ingredient->strength->value,
                        'strength_unit' => $ingredient->strength->unit,
                    ]);
                }
            });
        } catch (Throwable $e) {
            throw new InfrastructureException("Error saving product: " . $e->getMessage(), 0, $e);
        }
    }

    public function remove(Product $product): void
    {
        ProductModel::where('public_id', $product->getId())->delete();
    }

    public function existsActiveIngredient(string $name): bool
    {
        return ActiveCompoundModel::where('name', $name)->exists();
    }
}
