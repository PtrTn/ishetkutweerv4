<?php

namespace App\Domain\Rule\Wind;

use App\Domain\Dto\WeatherDto;
use App\Domain\ValueObject\Rating;
use App\Domain\Rule\WeatherRule;

class SomeWindRule implements WeatherRule
{
    public function matches(WeatherDto $dto): bool
    {
        return $dto->windSpeed > 4;
    }

    public function getRating(WeatherDto $dto): Rating
    {
        return Rating::beetjeKut();
    }
}
