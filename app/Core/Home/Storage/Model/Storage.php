<?php

namespace App\Core\Home\Storage\Model;

use App\Core\Shared\Domain\Utils;
use Carbon\Carbon;

final class Storage
{
    private function __construct(
        protected string $id,
        protected string $placeId,
        protected string $name,
        protected Carbon $createdAt
    )
    {
    }

    public static function create(
        string $placeId,
        string $name
    ): Storage
    {
        return new self(Utils::generateUUIDV4(), $placeId, $name, Carbon::now());
    }

    public static function load(string $id, string $placeId, string $name, Carbon $createdAt): Storage
    {
        return new self($id, $placeId, $name, $createdAt);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPlaceId(): string
    {
        return $this->placeId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }
}
