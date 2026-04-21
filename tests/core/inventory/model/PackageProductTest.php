<?php

namespace Tests\core\inventory\model;

use App\core\inventory\model\ProductStatus;
use Nette\InvalidStateException;
use PHPUnit\Framework\TestCase;

class PackageProductTest extends TestCase
{
    public function testCreatePackageProduct(): void
    {
        $product = PackageProductMother::generateValidEntity();

        self::assertNotEmpty($product->id);
        self::assertEquals(PackageProductMother::generateMedicine(), $product->medicine);
        self::assertEquals(PackageProductMother::generateSubstances(), $product->substances()->toArray());
        self::assertEquals(PackageProductMother::generatePresentation(), $product->presentation);
        self::assertEquals(PackageProductMother::generateExpirationDate(), $product->expirationDate);
        self::assertSame(PackageProductMother::generatePresentation()->totalAmount, $product->quantity());
        self::assertSame(ProductStatus::OK, $product->status());
    }

    public function testLoadPackageProduct(): void
    {
        $product = PackageProductMother::generateLoadedEntity(
            id: '00000000-0000-4000-8000-000000000001',
            medicine: PackageProductMother::generateMedicine('Loaded Medicine'),
            substances: [PackageProductMother::generateSubstance('Loaded substance', 'Loaded description')],
            presentation: PackageProductMother::generatePresentation('Capsule', 12, 'mg'),
            quantity: 8,
            expirationDate: PackageProductMother::generateExpirationDate('2026-12-31'),
            status: ProductStatus::OK,
            addedDate: new \DateTime('2024-01-16 10:00:00')
        );

        self::assertSame('00000000-0000-4000-8000-000000000001', $product->id);
        self::assertSame('Loaded Medicine', $product->medicine->brandName);
        self::assertCount(1, $product->substances()->toArray());
        self::assertSame('Capsule', $product->presentation->shape);
        self::assertSame(8, $product->quantity());
        self::assertSame('2026-12-31', $product->expirationDate->format('Y-m-d'));
        self::assertSame(ProductStatus::OK, $product->status());
        self::assertSame('2024-01-16 10:00:00', $product->addedDate()->format('Y-m-d H:i:s'));
    }

    public function testConsumePackageProduct(): void
    {
        $product = PackageProductMother::generateLoadedEntity(quantity: 2);

        $product->consume();

        self::assertSame(1, $product->quantity());
        self::assertSame(ProductStatus::OK, $product->status());

        $product->consume();

        self::assertSame(0, $product->quantity());
        self::assertSame(ProductStatus::CONSUMED, $product->status());

        $otherProduct = PackageProductMother::generateLoadedEntity(quantity: 20);
        $otherProduct->consume(5);

        self::assertSame(15, $otherProduct->quantity());
        self::assertSame(ProductStatus::OK, $otherProduct->status());
    }

    public function testConsumeConsumedPackageProductThrowsException(): void
    {
        $product = PackageProductMother::generateLoadedEntity(quantity: 1);

        $product->consume();

        self::expectException(InvalidStateException::class);
        self::expectExceptionMessage('Not enough quantity to consume.');
        $product->consume();

        $otherProduct = PackageProductMother::generateLoadedEntity(quantity: 7);
        self::expectException(InvalidStateException::class);
        self::expectExceptionMessage('Not enough quantity to consume.');
        $otherProduct->consume(50);
    }
}
