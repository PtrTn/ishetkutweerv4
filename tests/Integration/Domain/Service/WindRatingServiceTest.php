<?php

declare(strict_types=1);

namespace App\Tests\Integration\Domain\Service;

use App\Domain\Model\CurrentWeather;
use App\Domain\Service\RatingService;
use App\Domain\ValueObject\Rating;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class WindRatingServiceTest extends KernelTestCase
{
    private RatingService $ratingService;

    public function setUp(): void
    {
        self::bootKernel();
        $ratingService = self::$container->get('WindRatingService');
        if ($ratingService instanceof RatingService) {
            $this->ratingService = $ratingService;

            return;
        }

        $this->fail('Unexpected type for rating service in container');
    }

    /**
     * @test
     */
    public function shouldReturnMegaKutForTooMuchWind(): void
    {
        $currentWeather = $this->getCurrentWeatherForWindSpeed(10);

        $rating = $this->ratingService->getRating($currentWeather);

        $this->assertEquals(
            Rating::megaKut(),
            $rating,
            'Too much wind should return mega kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturnKutForAlotWind(): void
    {
        $currentWeather = $this->getCurrentWeatherForWindSpeed(8);

        $rating = $this->ratingService->getRating($currentWeather);

        $this->assertEquals(
            Rating::kut(),
            $rating,
            'A lot of wind should return kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturnBeetjeKutForSomeWind(): void
    {
        $currentWeather = $this->getCurrentWeatherForWindSpeed(5);

        $rating = $this->ratingService->getRating($currentWeather);

        $this->assertEquals(
            Rating::beetjeKut(),
            $rating,
            'Some wind should return beetje kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturNietKutForLittleWind(): void
    {
        $currentWeather = $this->getCurrentWeatherForWindSpeed(3);

        $rating = $this->ratingService->getRating($currentWeather);

        $this->assertEquals(
            Rating::nietKut(),
            $rating,
            'Little wind should return niet kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturNietKutForNoWind(): void
    {
        $currentWeather = $this->getCurrentWeatherForWindSpeed(0);

        $rating = $this->ratingService->getRating($currentWeather);

        $this->assertEquals(
            Rating::nietKut(),
            $rating,
            'No wind should return niet kut rating'
        );
    }

    private function getCurrentWeatherForWindSpeed(float $windSpeed): CurrentWeather
    {
        return new CurrentWeather(10, 0, $windSpeed, 90);
    }
}
