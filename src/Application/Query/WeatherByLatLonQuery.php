<?php

declare(strict_types=1);

namespace App\Application\Query;

class WeatherByLatLonQuery
{
    public float $lat;

    public float $lon;

    public function __construct(float $lat, float $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }
}
