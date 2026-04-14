<?php

namespace App\core\product\model;

use App\core\shared\domain\Utils;
use Carbon\Carbon;

final class Product
{
    private function __construct(
        private string           $id,
        private string           $name,
        private string           $description,
        private PresentationType $presentationType,
        private Concentration    $concentration,
        private Carbon           $addedDate,
    )
    {
    }

    public static function create(
        string           $name,
        string           $description,
        PresentationType $presentationType,
        Concentration    $concentration
    ): Product
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
