<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient;

use App\Infrastructure\Dto\Buienradar\BuienradarnlDto;

interface BuienradarApiClientInterface
{
    public function getData(): BuienradarnlDto;
}
