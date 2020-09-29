<?php

declare(strict_types=1);

namespace App\Domain\Dto;

use App\Domain\ValueObject\Rating;

class WeatherRatingDto
{
    public Rating $temperatureRating;

    public Rating $rainRating;

    public Rating $windRating;

    public Rating $averageRating;
}
