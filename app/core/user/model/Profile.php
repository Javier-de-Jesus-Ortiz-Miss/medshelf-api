<?php

namespace App\core\user\model;

final class Profile
{
    public readonly string $id;
    private string $name;
    private int $age;
    private function __construct(string $id, string $name, int $age) {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function rename(string $name): void
    {
        // TODO: validate name
        $this->name = $name;
    }

    public function age(): int {
        return $this->age;
    }

    public function changeAge(int $age): void
    {
        $this->age = $age;
    }
}
