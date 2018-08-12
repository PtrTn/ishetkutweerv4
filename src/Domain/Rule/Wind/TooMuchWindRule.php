<?php

namespace App\Domain\Rule\Wind;

use App\Domain\Dto\WeatherDto;
use App\Domain\ValueObject\Rating;
use App\Domain\Rule\WeatherRule;

class TooMuchWindRule implements WeatherRule
{
    public function matches(WeatherDto $dto): bool
    {
        return isset($dto->windSpeed) && $dto->windSpeed > 9;
    }

    public function getRating(WeatherDto $dto): Rating
    {
        return Rating::megaKut();
    }
}
