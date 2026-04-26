<?php

namespace App\Core\Item\Model;

interface MedicalItemRepository
{
    public function findById(string $id): ?MedicalItem;

    public function save(MedicalItem $item): void;

    public function deleteById(string $id): void;

    public function exists(string $id): bool;

    public function consume(Consumption $consumption): void;
}
