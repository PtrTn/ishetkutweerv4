<?php

declare(strict_types=1);

namespace App\Domain\Rule\Rain;

use App\Domain\Dto\WeatherDto;
use App\Domain\Rule\WeatherRule;
use App\Domain\ValueObject\Rating;

class AlotRainRule implements WeatherRule
{
    public function matches(WeatherDto $dto): bool
    {
        return isset($dto->rain) && $dto->rain > 10;
    }

    public function getRating(WeatherDto $dto): Rating
    {
        return Rating::kut();
    }
}
