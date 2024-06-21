<?php

declare(strict_types=1);

namespace App\Domain\Pokemon\Builder;

use App\Domain\Pokemon\ValueObject\Dto\PokemonDto;

class PokemonListBuilder
{
    /**
     * @param array<string, mixed> $data
     *
     * @return PokemonDto[]
     */
    public function buildPokemonList(array $data): array
    {
        $pokemonList = [];

        foreach ($data['pokemon_v2_pokemontypes'] as $pokemonData) {
            $pokemonList[$data['id']] = new PokemonDto(
                id: $pokemonData['id'],
                name: $pokemonData['name'],
                spriteUrl: sprintf('https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/%d.png', $pokemonData['id']),
            );
        }

        return $pokemonList;
    }
}
