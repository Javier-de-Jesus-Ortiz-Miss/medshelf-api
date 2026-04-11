<?php

namespace App\core\inventory\model;

interface PackageProductRepository
{
    function save(PackageProduct $packageProduct): void;

    function update(PackageProduct $packageProduct): void;

    function deleteById(string $id): void;

    function findById(string $id): ?PackageProduct;
}
