<?php

namespace App\core\shared\domain;

class ImmutableArray {
    private array $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function get($key) {
        return $this->data[$key] ?? null;
    }

    public function toArray(): array {
        return $this->data;
    }
}
