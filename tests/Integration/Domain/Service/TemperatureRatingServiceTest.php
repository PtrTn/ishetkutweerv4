<?php

namespace App\Tests\Integration\Domain\Service;

use App\Domain\Dto\WeatherDto;
use App\Domain\Service\RatingService;
use App\Domain\ValueObject\Rating;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TemperatureRatingServiceTest extends KernelTestCase
{
    /**
     * @var RatingService
     */
    private $ratingService;

    public function setUp(): void
    {
        self::bootKernel();
        $this->ratingService = self::$container->get('TemperatureRatingService');
    }

    /**
     * @test
     */
    public function shouldReturnMegaKutForTooHot()
    {
        $dto = new WeatherDto();
        $dto->temperature = 40.0;

        $rating = $this->ratingService->getRating($dto);

        $this->assertEquals(
            Rating::megaKut(),
            $rating,
            'Too hot should return mega kut rating'
        );
    }

    public function shouldReturnMegaKutForTooCold()
    {
        $dto = new WeatherDto();
        $dto->temperature = -15.0;

        $rating = $this->ratingService->getRating($dto);

        $this->assertEquals(
            Rating::megaKut(),
            $rating,
            'Too cold temperatures should return mega kut rating'
        );
    }

    public function shouldReturnKutForHot()
    {
        $dto = new WeatherDto();
        $dto->temperature = 33.0;

        $rating = $this->ratingService->getRating($dto);

        $this->assertEquals(
            Rating::kut(),
            $rating,
            'Hot temperatures should return kut rating'
        );
    }

    public function shouldReturnKutForCold()
    {
        $dto = new WeatherDto();
        $dto->temperature = -5.0;

        $rating = $this->ratingService->getRating($dto);

        $this->assertEquals(
            Rating::kut(),
            $rating,
            'Cold temperatures should return kut rating'
        );
    }

    public function shouldReturnBeetjeKutForMild()
    {
        $dto = new WeatherDto();
        $dto->temperature = 5.0;

        $rating = $this->ratingService->getRating($dto);

        $this->assertEquals(
            Rating::beetjeKut(),
            $rating,
            'Mild temperature should result in beetje kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturnNietKutForUnknownTemperature()
    {
        $dto = new WeatherDto();

        $rating = $this->ratingService->getRating($dto);

        $this->assertEquals(
            Rating::nietKut(),
            $rating,
            'Unknown weather data should result in niet kut rating'
        );
    }
}
