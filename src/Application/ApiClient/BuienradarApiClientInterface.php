<?php

namespace App\Application\ApiClient;

use App\Application\Dto\Buienradar\BuienradarnlDto;

interface BuienradarApiClientInterface
{
    public function getData(): BuienradarnlDto;
}
