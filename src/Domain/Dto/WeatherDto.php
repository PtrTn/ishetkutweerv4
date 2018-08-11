<?php

namespace App\Domain\Dto;

class WeatherDto
{
    /**
     * @var string
     */
    public $location;

    /**
     * @var \DateTimeImmutable
     */
    public $date;

    /**
     * @var float|null
     */
    public $temperature;

    /**
     * @var float|null
     */
    public $rain;

    /**
     * @var float|null
     */
    public $windSpeed;

    /**
     * @var string
     */
    public $windDirection;

    /**
     * @var int
     */
    public $rating;

    /**
     * @var string
     */
    public $background;
}
