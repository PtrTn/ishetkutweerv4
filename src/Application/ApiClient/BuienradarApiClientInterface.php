<?php

declare(strict_types=1);

namespace App\Application\ApiClient;

use App\Application\Dto\Buienradar\BuienradarnlDto;

interface BuienradarApiClientInterface
{
    public function getData(): BuienradarnlDto;
}
