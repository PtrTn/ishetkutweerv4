<?php

namespace App\Application\Factory;

use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingsDto;
use App\Domain\Service\RainRatingService;
use App\Domain\Service\TemperatureRatingService;
use App\Domain\Service\WindRatingService;

class WeatherRatingsDtoFactory
{
    /**
     * @var TemperatureRatingService
     */
    private $temperatureRatingService;
    /**
     * @var RainRatingService
     */
    private $rainRatingService;
    /**
     * @var WindRatingService
     */
    private $windRatingService;

    public function __construct(
        TemperatureRatingService $temperatureRatingService,
        RainRatingService $rainRatingService,
        WindRatingService $windRatingService
    )
    {
        $this->temperatureRatingService = $temperatureRatingService;
        $this->rainRatingService = $rainRatingService;
        $this->windRatingService = $windRatingService;
    }

    public function create(WeatherDto $weatherDto): WeatherRatingsDto
    {
        $dto = new WeatherRatingsDto();
        $dto->temperatureRating = $this->temperatureRatingService->getRating($weatherDto);
        $dto->rainRating = $this->rainRatingService->getRating($weatherDto);
        $dto->windRating = $this->windRatingService->getRating($weatherDto);
        return $dto;
    }
}
