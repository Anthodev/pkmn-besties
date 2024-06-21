<?php

declare(strict_types=1);

namespace App\Domain\Pokemon\Fetcher;

use App\Application\Enum\HttpMethodEnum;
use App\Application\Enum\HttpResponseStatusCodeEnum;
use App\Domain\Pokemon\Builder\PokemonListBuilder;
use App\Domain\Pokemon\Enum\PokeApiVariableOperatorEnum;
use App\Domain\Pokemon\Exception\ExternalApiNotReachableException;
use App\Domain\Pokemon\Exception\FetcherJsonResponseValidationException;
use App\Domain\Pokemon\ValueObject\Dto\PokemonDto;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class PokemonFetcher
{
    public function __construct(
        private PokemonListBuilder $pokemonListBuilder,
    ) {
    }

    public function createPokeApiGraphQlClient(): HttpClientInterface
    {
        $client = HttpClient::create();

        $client
            ->withOptions(
                (new HttpOptions())
                    ->setHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ])
                ->toArray()
            );

        return $client;
    }

    /**
     * @param array<string, mixed> $variables
     * @return array<string, mixed>
     *
     * @throws FetcherJsonResponseValidationException
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function doGraphQlQuery(string $query, array $variables = []): array
    {
        $payload = '{
            "query": "' . $query . '",
            "variables": ' . json_encode($variables) . '
        }';
        dump($payload);

        $response = $this->createPokeApiGraphQlClient()
            ->request(
                method: HttpMethodEnum::POST->value,
                url: 'https://beta.pokeapi.co/graphql/v1beta',
                options: (new HttpOptions())
                    ->setJson($payload)
                    ->toArray()
            )
        ;

        dd($response->getContent());

        if (HttpResponseStatusCodeEnum::OK->value !== $response->getStatusCode()) {
            throw new ExternalApiNotReachableException();
        }

        if (false === json_validate($response->getContent())) {
            throw new FetcherJsonResponseValidationException();
        }

        $responseData = json_decode($response->getContent(), true);

        if (!isset($responseData['data']['pokemon_v2_type'])) {
            return [];
        }

        return $responseData;
    }

    /**
     * @return PokemonDto[]
     *
     * @throws ClientExceptionInterface
     * @throws FetcherJsonResponseValidationException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getPokemonList(): array
    {
        $payload = <<<'GRAPHQL'
            query pokemonListByType {
                pokemon_v2_type {
                    id
                    name
                    pokemon_v2_pokemontypes {
                        pokemon_v2_pokemon {
                            id
                            name
                        }
                    }
                }
            }
        GRAPHQL;

        $response = $this->doGraphQlQuery(query: $payload);
        dump($response);

        return $this->pokemonListBuilder->buildPokemonList($response['data']['pokemon_v2_type']);
    }

    /**
     * @return PokemonDto[]
     *
     * @throws ClientExceptionInterface
     * @throws FetcherJsonResponseValidationException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getPokemonListByType(int $typeId): array
    {
        $payload = <<<'GRAPHQL'
            query pokemonListByType($id: Int_comparison_exp = {}) {
                pokemon_v2_type(where: {id: $id}) {
                    name
                    pokemon_v2_pokemontypes {
                        pokemon_v2_pokemon {
                            id
                            name
                        }
                    }
                }
            }
        GRAPHQL;

        $variables = [
            'id' => [
                PokeApiVariableOperatorEnum::EQ->value => $typeId,
            ],
        ];

        $response = $this->doGraphQlQuery($payload, $variables);

        return $this->pokemonListBuilder->buildPokemonList($response['data']['pokemon_v2_type']);
    }
}
