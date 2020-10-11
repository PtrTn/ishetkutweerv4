<?php

declare(strict_types=1);

namespace App\Infrastructure\Middleware;

use Symfony\Component\HttpFoundation\Response;

final class CacheMiddleware implements CacheMiddlewareInterface
{
    public function apply(Response $response, int $maxAge): Response
    {
        $response->setPublic();
        $response->setMaxAge($maxAge);

        return $response;
    }
}
