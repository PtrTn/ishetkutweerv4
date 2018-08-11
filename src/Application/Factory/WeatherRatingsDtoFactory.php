<?php

namespace App\Application\Factory;

use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingsDto;
use App\Domain\Service\RatingService;

class WeatherRatingsDtoFactory
{
    /**
     * @var RatingService
     */
    private $temperatureRatingService;
    /**
     * @var RatingService
     */
    private $rainRatingService;
    /**
     * @var RatingService
     */
    private $windRatingService;

    public function __construct(
        RatingService $temperatureRatingService,
        RatingService $rainRatingService,
        RatingService $windRatingService
    ) {
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
