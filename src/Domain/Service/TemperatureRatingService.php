<?php

namespace App\Domain\Service;

use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingEnum;
use App\Domain\Rule\WeatherRule;

class TemperatureRatingService
{
    /**
     * @var WeatherRule[]|iterable
     */
    private $rules;

    /**
     * @param WeatherRule[]|iterable $rules
     */
    public function __construct(iterable $rules)
    {
        $this->rules = $rules;
    }

    public function getRating(WeatherDto $dto): WeatherRatingEnum
    {
        foreach ($this->rules as $rule) {
            if ($rule->matches($dto)) {
                return $rule->getRating($dto);
            }
        }

        return WeatherRatingEnum::nietKut();
    }
}
