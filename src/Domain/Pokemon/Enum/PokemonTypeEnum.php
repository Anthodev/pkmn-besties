<?php

declare(strict_types=1);

namespace App\Domain\Pokemon\Enum;

enum PokemonTypeEnum: int
{
    case NORMAL = 1;
    case FIGHTING = 2;
    case FLYING = 3;
    case POISON = 4;
    case GROUND = 5;
    case ROCK = 6;
    case BUG = 7;
    case GHOST = 8;
    case STEEL = 9;
    case FIRE = 10;
    case WATER = 11;
    case GRASS = 12;
    case ELECTRIC = 13;
    case PSYCHIC = 14;
    case ICE = 15;
    case DRAGON = 16;
    case DARK = 17;
    case FAIRY = 18;
    case STELLAR = 19;
    case UNKNOWN = 10001;
    case SHADOW = 10002;
}
