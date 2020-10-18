<?php

declare(strict_types=1);

namespace App\Application\Query;

class WeatherByCityQuery
{
    public string $city;

    public function __construct(string $city)
    {
        $this->city = $city;
    }
}
