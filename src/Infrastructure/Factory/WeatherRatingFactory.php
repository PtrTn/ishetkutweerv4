<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Model\CurrentWeather;
use App\Domain\Model\WeatherRating;
use App\Domain\Service\RatingService;
use App\Domain\ValueObject\Rating;

use function array_sum;
use function count;
use function round;

class WeatherRatingFactory
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

    public function create(CurrentWeather $currentWeather): WeatherRating
    {
        $temperatureRating = $this->temperatureRatingService->getRating($currentWeather);
        $rainRating = $this->rainRatingService->getRating($currentWeather);
        $windRating = $this->windRatingService->getRating($currentWeather);
        $averageRating = $this->calculateAverageRating($temperatureRating, $rainRating, $windRating);

        return new WeatherRating(
            $temperatureRating,
            $rainRating,
            $windRating,
            $averageRating
        );
    }

    private function calculateAverageRating(
        Rating $temperatureRating,
        Rating $rainRating,
        Rating $windRating
    ): Rating {
        $ratings = [
            $temperatureRating,
            $rainRating,
            $windRating,
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
