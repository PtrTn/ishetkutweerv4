<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Model\CurrentWeather;
use App\Domain\Rule\WeatherRule;
use App\Domain\ValueObject\Rating;

class RatingService
{
    /** @var WeatherRule[]|iterable */
    private iterable $rules;

    /**
     * @param WeatherRule[]|iterable $rules
     */
    public function __construct(iterable $rules)
    {
        $this->rules = $rules;
    }

    public function getRating(CurrentWeather $currentWeather): Rating
    {
        foreach ($this->rules as $rule) {
            if ($rule->matches($currentWeather)) {
                return $rule->getRating();
            }
        }

        return Rating::nietKut();
    }
}
