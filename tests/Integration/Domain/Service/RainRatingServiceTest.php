<?php

declare(strict_types=1);

namespace App\Tests\Integration\Domain\Service;

use App\Domain\Model\CurrentWeather;
use App\Domain\Service\RatingService;
use App\Domain\ValueObject\Rating;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RainRatingServiceTest extends KernelTestCase
{
    private RatingService $ratingService;

    public function setUp(): void
    {
        self::bootKernel();
        $ratingService = self::$container->get('RainRatingService');
        if ($ratingService instanceof RatingService) {
            $this->ratingService = $ratingService;

            return;
        }

        $this->fail('Unexpected type for rating service in container');
    }

    /**
     * @test
     */
    public function shouldReturnMegaKutForTooMuchRain(): void
    {
        $currentWeather = $this->getCurrentWeatherForRain(35);

        $rating = $this->ratingService->getRating($currentWeather);

        $this->assertEquals(
            Rating::megaKut(),
            $rating,
            'Too much rain should result in mega kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturnKutForAlotRain(): void
    {
        $currentWeather = $this->getCurrentWeatherForRain(15);

        $rating = $this->ratingService->getRating($currentWeather);

        $this->assertEquals(
            Rating::kut(),
            $rating,
            'A lot of rain should result in a kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturnBeetjeKutForSomeRain(): void
    {
        $currentWeather = $this->getCurrentWeatherForRain(5);

        $rating = $this->ratingService->getRating($currentWeather);

        $this->assertEquals(
            Rating::beetjeKut(),
            $rating,
            'Some rain should result in a beetje kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturnNietKutForNoRain(): void
    {
        $currentWeather = $this->getCurrentWeatherForRain(0);

        $rating = $this->ratingService->getRating($currentWeather);

        $this->assertEquals(
            Rating::nietKut(),
            $rating,
            'No rain should result in niet kut rating'
        );
    }

    private function getCurrentWeatherForRain(float $rain): CurrentWeather
    {
        return new CurrentWeather(10, $rain, 5, 90);
    }
}
