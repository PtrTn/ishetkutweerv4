<?php

declare(strict_types=1);

namespace App\Infrastructure\Middleware;

use Symfony\Component\HttpFoundation\Response;

interface CacheMiddlewareInterface
{
    public const FIVE_MINUTES = 300;
    public const ONE_HOUR = 3600;

    public function apply(Response $response, int $maxAge): Response;
}
