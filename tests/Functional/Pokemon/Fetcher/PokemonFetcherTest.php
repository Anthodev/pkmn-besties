<?php

declare(strict_types=1);

namespace App\Tests\Functional\Pokemon\Fetcher;

use App\Domain\Pokemon\Fetcher\PokemonFetcher;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PokemonFetcherTest extends WebTestCase
{
    private readonly PokemonFetcher $pokemonFetcher;

    public function setUp(): void
    {
        parent::setUp();

        $this->pokemonFetcher = self::getContainer()->get(PokemonFetcher::class);
    }

    public function testGetPokemonList(): void
    {
        $pokemonList = $this->pokemonFetcher->getPokemonList();

        dump($pokemonList);
        $this->assertNotEmpty($pokemonList);
    }
}
