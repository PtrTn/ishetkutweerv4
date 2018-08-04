<?php

namespace App\Application\Query;

class WeatherDataQuery
{
    /**
     * @var float
     */
    public $lat;

    /**
     * @var float
     */
    public $lon;

    public function __construct(float $lat, float $lon) {
        $this->lat = $lat;
        $this->lon = $lon;
    }
}
