<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\ValueObject\Rating;

class WeatherRating
{
    private Rating $temperatureRating;

    private Rating $rainRating;

    private Rating $windRating;

    private Rating $averageRating;

    public function __construct(
        Rating $temperatureRating,
        Rating $rainRating,
        Rating $windRating,
        Rating $averageRating
    ) {
        $this->temperatureRating = $temperatureRating;
        $this->rainRating = $rainRating;
        $this->windRating = $windRating;
        $this->averageRating = $averageRating;
    }

    public function getTemperatureRating(): Rating
    {
        return $this->temperatureRating;
    }

    public function getRainRating(): Rating
    {
        return $this->rainRating;
    }

    public function getWindRating(): Rating
    {
        return $this->windRating;
    }

    public function getAverageRating(): Rating
    {
        return $this->averageRating;
    }
}
