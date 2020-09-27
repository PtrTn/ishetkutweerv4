<?php

namespace App\Application\Query;

class WeatherByLocationQuery
{
    /**
     * @var string
     */
    public $location;

    public function __construct(string $location)
    {
        $this->location = $location;
    }
}
