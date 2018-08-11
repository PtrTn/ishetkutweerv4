<?php

namespace App\Domain\Rule\Temperature;

use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingEnum;
use App\Domain\Rule\WeatherRule;

class MildRule implements WeatherRule
{
    public function matches(WeatherDto $dto): bool
    {
        return $dto->temperature < 10;
    }

    public function getRating(WeatherDto $dto): WeatherRatingEnum
    {
        return WeatherRatingEnum::beetjeKut();
    }
}
