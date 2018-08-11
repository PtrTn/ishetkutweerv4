<?php

namespace App\Application\Factory;

use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingsDto;
use App\Domain\Service\TemperatureRatingService;

class WeatherRatingsDtoFactory
{
    /**
     * @var TemperatureRatingService
     */
    private $temperatureRatingService;

    public function __construct(
        TemperatureRatingService $temperatureRatingService
    )
    {
        $this->temperatureRatingService = $temperatureRatingService;
    }

    public function create(WeatherDto $weatherDto): WeatherRatingsDto
    {
        $dto = new WeatherRatingsDto();
        $dto->temperatureRating = $this->temperatureRatingService->getRating($weatherDto);
        return $dto;
    }
}
