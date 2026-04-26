<?php

namespace App\Providers\Core\Product;

use App\Core\Product\Model\Concentration;
use App\Core\Product\Model\MedicalProduct;
use App\Core\Product\Model\MedicalProductRepository;
use App\Core\Product\Model\PresentationType;
use App\Models\ProductModel;

class MedicalProductRepositoryAdapter implements MedicalProductRepository
{

    public function findById(string $id): ?MedicalProduct
    {
        $record = ProductModel::where('public_id', $id)->first();
        if (!$record) return null;
        return $this->toDomain($record);
    }

    private function toDomain(ProductModel $productModel): MedicalProduct
    {
        return MedicalProduct::load(
            id: $productModel->public_id,
            name: $productModel->name,
            description: $productModel->description,
            presentationType: new PresentationType($productModel->presentation_type),
            concentration: new Concentration(
                unit: $productModel->concentration_unit,
                value: $productModel->concentration_value
            ),
            addedDate: $productModel->created_at
        );
    }

    public function save(MedicalProduct $product): void
    {
        ProductModel::updateOrCreate(
            ['public_id' => $product->getId()],
            [
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'presentation_type' => $product->getPresentationType()->value,
                'concentration_unit' => $product->getConcentration()->unit,
                'concentration_value' => $product->getConcentration()->value,
            ]
        );
    }

    public function deleteById(string $id): void
    {
        ProductModel::where('public_id', $id)->delete();
    }

    public function exists(string $id): bool
    {
        return ProductModel::where('public_id', $id)->exists();
    }
}
