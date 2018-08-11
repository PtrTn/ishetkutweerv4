<?php

namespace App\Domain\Dto;

class WeatherRatingsDto
{
    /**
     * @var WeatherRatingEnum
     */
    public $temperatureRating;

    /**
     * @var WeatherRatingEnum
     */
    public $rainRating;

    /**
     * @var WeatherRatingEnum
     */
    public $windRating;
}
