<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingDto;
use App\Domain\Service\RatingService;
use App\Domain\ValueObject\Rating;

use function array_sum;
use function count;
use function round;

class WeatherRatingDtoFactory
{
    private RatingService $temperatureRatingService;
    private RatingService $rainRatingService;
    private RatingService $windRatingService;

    public function __construct(
        RatingService $temperatureRatingService,
        RatingService $rainRatingService,
        RatingService $windRatingService
    ) {
        $this->temperatureRatingService = $temperatureRatingService;
        $this->rainRatingService = $rainRatingService;
        $this->windRatingService = $windRatingService;
    }

    public function create(WeatherDto $weatherDto): WeatherRatingDto
    {
        $dto = new WeatherRatingDto();
        $dto->temperatureRating = $this->temperatureRatingService->getRating($weatherDto);
        $dto->rainRating = $this->rainRatingService->getRating($weatherDto);
        $dto->windRating = $this->windRatingService->getRating($weatherDto);
        $dto->averageRating = $this->calculateAverageRating($dto);

        return $dto;
    }

    private function calculateAverageRating(WeatherRatingDto $dto): Rating
    {
        $ratings = [
            $dto->temperatureRating->getRating(),
            $dto->rainRating->getRating(),
            $dto->windRating->getRating(),
        ];
        $rating = round(array_sum($ratings) / count($ratings));

        if ($rating <= Rating::NIET_KUT) {
            return Rating::nietKut();
        }

        if ($rating <= Rating::BEETJE_KUT) {
            return Rating::beetjeKut();
        }

        if ($rating <= Rating::KUT) {
            return Rating::kut();
        }

        return Rating::megaKut();
    }
}
