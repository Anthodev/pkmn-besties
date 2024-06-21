<?php

declare(strict_types=1);

namespace App\Domain\Pokemon\ValueObject\Dto;

readonly class PokemonDto
{
    public function __construct(
        private int $id,
        private string $name,
        private string $spriteUrl
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSpriteUrl(): string
    {
        return $this->spriteUrl;
    }
}
