<?php

declare(strict_types=1);

namespace App\Infrastructure\Middleware;

use Symfony\Component\HttpFoundation\Response;

/** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
final class NoCacheMiddleware implements CacheMiddlewareInterface
{
    public function apply(Response $response, int $maxAge): Response
    {
        return $response;
    }
}
