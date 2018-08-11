<?php

namespace App\Domain\Rule\Temperature;

use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingEnum;
use App\Domain\Rule\WeatherRule;

class HotOrColdRule implements WeatherRule
{
    public function matches(WeatherDto $dto): bool
    {
        return $dto->temperature > 30 || $dto->temperature < -10;
    }

    public function getRating(WeatherDto $dto): WeatherRatingEnum
    {
        return WeatherRatingEnum::megaKut();
    }
}
