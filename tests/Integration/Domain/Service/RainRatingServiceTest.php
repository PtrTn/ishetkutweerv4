<?php

namespace App\Tests\Integration\Domain\Service;

use App\Domain\Dto\WeatherDto;
use App\Domain\Service\RatingService;
use App\Domain\ValueObject\Rating;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RainRatingServiceTest extends WebTestCase
{
    /**
     * @var RatingService
     */
    private $ratingService;

    public function setUp()
    {
        self::bootKernel();
        $this->ratingService = self::$container->get('RainRatingService');
    }

    /**
     * @test
     */
    public function shouldReturnMegaKutForTooMuchRain()
    {
        $dto = new WeatherDto();
        $dto->rain = 35.0;

        $rating = $this->ratingService->getRating($dto);

        $this->assertEquals(
            Rating::megaKut(),
            $rating,
            'Too much rain should result in mega kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturnKutForAlotRain()
    {
        $dto = new WeatherDto();
        $dto->rain = 15.0;

        $rating = $this->ratingService->getRating($dto);

        $this->assertEquals(
            Rating::kut(),
            $rating,
            'A lot of rain should result in a kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturnBeetjeKutForSomeRain()
    {
        $dto = new WeatherDto();
        $dto->rain = 5.0;

        $rating = $this->ratingService->getRating($dto);

        $this->assertEquals(
            Rating::beetjeKut(),
            $rating,
            'Some rain should result in a beetje kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturnNietKutForNoRain()
    {
        $dto = new WeatherDto();
        $dto->rain = 0.0;

        $rating = $this->ratingService->getRating($dto);

        $this->assertEquals(
            Rating::nietKut(),
            $rating,
            'No rain should result in niet kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturnNietKutForUnknownRain()
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
