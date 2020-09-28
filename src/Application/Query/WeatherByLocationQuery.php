<?php

declare(strict_types=1);

namespace App\Application\Query;

class WeatherByLocationQuery
{
    public string $location;

    public function __construct(string $location)
    {
        $this->location = $location;
    }
}
