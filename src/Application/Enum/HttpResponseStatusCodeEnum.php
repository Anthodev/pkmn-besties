<?php

declare(strict_types=1);

namespace App\Application\Enum;

enum HttpResponseStatusCodeEnum: int
{
    case OK = 200;
    case CREATED = 201;
    case NO_CONTENT = 204;
    case REDIRECT = 302;
    case BAD_REQUEST = 400;
    case UNAUTHORIZED = 401;
    case FORBIDDEN = 403;
    case NOT_FOUND = 404;
    case METHOD_NOT_ALLOWED = 405;
    case NOT_PROCESSABLE_ENTITY = 422;
    case INTERNAL_SERVER_ERROR = 500;
    case CONNECTION_TIMEOUT = 503;
}
