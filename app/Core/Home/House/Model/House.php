<?php

namespace App\Core\Home\House\Model;

use App\Core\Shared\Domain\Utils;
use Carbon\Carbon;

final class House
{
    private function __construct(
        protected string $id,
        protected string $ownerId,
        protected string $name,
        protected Carbon $createdAt
    )
    {
    }

    /**
     * @param string $id
     * @param string $ownerId
     * @param string $name
     * @param Carbon $createdAt
     * @return House
     */
    public static function load(string $id, string $ownerId, string $name, Carbon $createdAt): House
    {
        return new self($id, $ownerId, $name, $createdAt);
    }

    public static function create(string $ownerId, string $name): House
    {
        return new self(Utils::generateUUIDV4(), $ownerId, $name, Carbon::now());
    }

    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
