<?php

namespace Tests\core\inventory\model;

use App\core\inventory\model\Medicine;
use App\core\inventory\model\PackageProduct;
use App\core\inventory\model\Presentation;
use App\core\inventory\model\ProductStatus;
use App\core\inventory\model\Substance;
use DateTime;

class PackageProductMother
{
    private const string MEDICINE_BRAND_NAME = 'Example Medicine';
    private const string PRESENTATION_SHAPE = 'Tablet';
    private const int PRESENTATION_TOTAL_AMOUNT = 20;
    private const string PRESENTATION_UNIT = 'mg';
    private const string EXPIRATION_DATE = '2025-12-31';
    private const string EXPIRED_DATE = '2020-12-31';
    private const string ADDED_DATE = '2024-01-15 10:00:00';

    public static function generateValidEntity(): PackageProduct
    {
        return PackageProduct::create(
            self::generateMedicine(),
            self::generatePresentation(),
            self::generateExpirationDate(),
            ...self::generateSubstances()
        );
    }

    public static function generateMedicine(?string $brandName = null): Medicine
    {
        return Medicine::create($brandName ?? self::MEDICINE_BRAND_NAME);
    }

    public static function generatePresentation(
        ?string $shape = null,
        ?int    $totalAmount = null,
        ?string $unit = null
    ): Presentation
    {
        return Presentation::create(
            $shape ?? self::PRESENTATION_SHAPE,
            $totalAmount ?? self::PRESENTATION_TOTAL_AMOUNT,
            $unit ?? self::PRESENTATION_UNIT
        );
    }

    public static function generateExpirationDate(?string $date = null): DateTime
    {
        return new DateTime($date ?? self::EXPIRATION_DATE);
    }

    public static function generateSubstances(): array
    {
        return [
            self::generateSubstance('example sódico'),
            self::generateSubstance('example sódico2'),
        ];
    }

    public static function generateSubstance(string $name): Substance
    {
        return Substance::create($name);
    }

    public static function generateExpiredEntity(): PackageProduct
    {
        return self::generateLoadedEntity(
            expirationDate: self::generateExpiredDate(),
            status: ProductStatus::EXPIRED
        );
    }

    public static function generateLoadedEntity(
        ?string        $id = null,
        ?Medicine      $medicine = null,
        ?array         $substances = null,
        ?Presentation  $presentation = null,
        ?int           $quantity = null,
        ?DateTime      $expirationDate = null,
        ?ProductStatus $status = null,
        ?DateTime      $addedDate = null
    ): PackageProduct
    {
        $presentation ??= self::generatePresentation();

        return PackageProduct::load(
            id: $id ?? '00000000-0000-4000-8000-000000000000',
            medicine: $medicine ?? self::generateMedicine(),
            substances: $substances ?? self::generateSubstances(),
            presentation: $presentation,
            quantity: $quantity ?? $presentation->totalAmount,
            expirationDate: $expirationDate ?? self::generateExpirationDate(),
            status: $status ?? ProductStatus::OK,
            addedDate: $addedDate ?? self::generateAddedDate()
        );
    }

    public static function generateAddedDate(?string $date = null): DateTime
    {
        return new DateTime($date ?? self::ADDED_DATE);
    }

    public static function generateExpiredDate(): DateTime
    {
        return new DateTime(self::EXPIRED_DATE);
    }

    public static function generateConsumedEntity(): PackageProduct
    {
        $presentation = self::generatePresentation();

        return self::generateLoadedEntity(
            presentation: $presentation,
            quantity: 0,
            status: ProductStatus::CONSUMED
        );
    }
}
