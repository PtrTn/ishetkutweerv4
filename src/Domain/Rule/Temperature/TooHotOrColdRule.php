<?php

namespace App\Domain\Rule\Temperature;

use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingEnum;
use App\Domain\Rule\WeatherRule;

class TooHotOrColdRule implements WeatherRule
{
    public function matches(WeatherDto $dto): bool
    {
        return $dto->temperature > 30 || $dto->temperature < 0;
    }

    public function getRating(WeatherDto $dto): WeatherRatingEnum
    {
        return WeatherRatingEnum::kut();
    }
}
