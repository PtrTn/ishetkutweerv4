<?php

declare(strict_types=1);

namespace App\Tests\Integration\Domain\Service;

use App\Domain\Model\CurrentWeather;
use App\Domain\Service\RatingService;
use App\Domain\ValueObject\Rating;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TemperatureRatingServiceTest extends KernelTestCase
{
    private RatingService $ratingService;

    public function setUp(): void
    {
        self::bootKernel();
        $ratingService = self::$container->get('TemperatureRatingService');
        if ($ratingService instanceof RatingService) {
            $this->ratingService = $ratingService;

            return;
        }

        $this->fail('Unexpected type for rating service in container');
    }

    /**
     * @test
     */
    public function shouldReturnMegaKutForTooHot(): void
    {
        $currentWeather = $this->getCurrentWeatherForTemperature(40);

        $rating = $this->ratingService->getRating($currentWeather);

        $this->assertEquals(
            Rating::megaKut(),
            $rating,
            'Too hot should return mega kut rating'
        );
    }

    public function shouldReturnMegaKutForTooCold(): void
    {
        $currentWeather = $this->getCurrentWeatherForTemperature(-15);

        $rating = $this->ratingService->getRating($currentWeather);

        $this->assertEquals(
            Rating::megaKut(),
            $rating,
            'Too cold temperatures should return mega kut rating'
        );
    }

    public function shouldReturnKutForHot(): void
    {
        $currentWeather = $this->getCurrentWeatherForTemperature(33);

        $rating = $this->ratingService->getRating($currentWeather);

        $this->assertEquals(
            Rating::kut(),
            $rating,
            'Hot temperatures should return kut rating'
        );
    }

    public function shouldReturnKutForCold(): void
    {
        $currentWeather = $this->getCurrentWeatherForTemperature(-5);

        $rating = $this->ratingService->getRating($currentWeather);

        $this->assertEquals(
            Rating::kut(),
            $rating,
            'Cold temperatures should return kut rating'
        );
    }

    public function shouldReturnBeetjeKutForMild(): void
    {
        $currentWeather = $this->getCurrentWeatherForTemperature(5);

        $rating = $this->ratingService->getRating($currentWeather);

        $this->assertEquals(
            Rating::beetjeKut(),
            $rating,
            'Mild temperature should result in beetje kut rating'
        );
    }

    private function getCurrentWeatherForTemperature(float $temperature): CurrentWeather
    {
        return new CurrentWeather($temperature, 0, 5, 90);
    }
}
