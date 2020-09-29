<?php

declare(strict_types=1);

namespace App\Domain\Dto;

class LocationDto
{
    public string $region;

    public string $stationName;

    public float $lat;

    public float $lon;
}
