<?php

namespace App\Domain\Dto;

use App\Domain\ValueObject\Rating;

class WeatherRatingDto
{
    /**
     * @var Rating
     */
    public $temperatureRating;

    /**
     * @var Rating
     */
    public $rainRating;

    /**
     * @var Rating
     */
    public $windRating;
}
