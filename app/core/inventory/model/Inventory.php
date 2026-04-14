<?php

namespace App\core\inventory\model;

final class Inventory
{
    public function __construct(
        private string $id,
        private string $ownerId,
        private string $name
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
