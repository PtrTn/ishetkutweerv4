<?php

declare(strict_types=1);

namespace App\Domain\Rule\Wind;

use App\Domain\Dto\WeatherDto;
use App\Domain\Rule\WeatherRule;
use App\Domain\ValueObject\Rating;

class SomeWindRule implements WeatherRule
{
    public function matches(WeatherDto $dto): bool
    {
        return isset($dto->windSpeed) && $dto->windSpeed > 4;
    }

    public function getRating(WeatherDto $dto): Rating
    {
        return Rating::beetjeKut();
    }
}
