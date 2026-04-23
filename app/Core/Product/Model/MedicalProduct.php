<?php

namespace App\Core\Product\Model;

use App\Core\Shared\Domain\Utils;
use Carbon\Carbon;

final class MedicalProduct
{
    private function __construct(
        protected string           $id,
        protected string           $name,
        protected string           $description,
        protected PresentationType $presentationType,
        protected Concentration    $concentration,
        protected Carbon           $addedDate,
    )
    {
    }

    public static function create(
        string           $name,
        string           $description,
        PresentationType $presentationType,
        Concentration    $concentration
    ): MedicalProduct
    {
        return new self(
            Utils::generateUUIDV4(),
            $name,
            $description,
            $presentationType,
            $concentration,
            Carbon::now()
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPresentationType(): PresentationType
    {
        return $this->presentationType;
    }

    public function getConcentration(): Concentration
    {
        return $this->concentration;
    }

    public function getAddedDate(): Carbon
    {
        return $this->addedDate;
    }
}
