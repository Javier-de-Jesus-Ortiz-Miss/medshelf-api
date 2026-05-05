<?php

namespace App\Core\Catalog\Product\Model;

use App\Core\Catalog\Product\Model\ValueObject\Composition;
use App\Core\Catalog\Product\Model\ValueObject\NetContent;
use App\Core\Catalog\Product\Model\ValueObject\PharmaceuticalForm;
use App\Core\Shared\Domain\Utils;
use Carbon\Carbon;

final class Product
{
    private function __construct(
        protected string             $id,
        protected string             $name,
        protected ?NetContent        $netContent,
        protected ?int               $totalQuantity,
        protected PharmaceuticalForm $pharmaceuticalForm,
        protected Carbon             $createdAt,
        protected Composition        $composition,
    )
    {
    }

    public static function create(
        string             $name,
        ?NetContent        $netContent,
        ?int               $quantity,
        PharmaceuticalForm $pharmaceuticalForm,
        Composition        $composition,
    ): Product
    {
        return new self(
            id: Utils::generateUUIDV4(),
            name: $name,
            netContent: $netContent,
            totalQuantity: $quantity,
            pharmaceuticalForm: $pharmaceuticalForm,
            createdAt: Carbon::now(),
            composition: $composition
        );
    }

    public static function load(
        string             $id,
        string             $name,
        ?NetContent        $netContent,
        ?int               $totalQuantity,
        PharmaceuticalForm $pharmaceuticalForm,
        Carbon             $createdAt,
        Composition        $composition,
    ): Product
    {
        return new self(
            id: $id,
            name: $name,
            netContent: $netContent,
            totalQuantity: $totalQuantity,
            pharmaceuticalForm: $pharmaceuticalForm,
            createdAt: $createdAt,
            composition: $composition
        );
    }

    public function getTotalQuantity(): ?float
    {
        return $this->totalQuantity;
    }

    public function getPharmaceuticalForm(): PharmaceuticalForm
    {
        return $this->pharmaceuticalForm;
    }

    public function getComposition(): Composition
    {
        return $this->composition;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNetContent(): ?NetContent
    {
        return $this->netContent;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }
}
