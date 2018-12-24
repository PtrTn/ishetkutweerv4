<?php

namespace App\Tests\Integration\Domain\Service;

use App\Domain\Dto\WeatherDto;
use App\Domain\Service\RatingService;
use App\Domain\ValueObject\Rating;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WindRatingServiceTest extends WebTestCase
{
    /**
     * @var RatingService
     */
    private $ratingService;

    public function setUp()
    {
        self::bootKernel();
        $this->ratingService = self::$container->get('WindRatingService');
    }

    /**
     * @test
     */
    public function shouldReturnMegaKutForTooMuchWind()
    {
        $dto = new WeatherDto();
        $dto->windSpeed = 10.0;

        $rating = $this->ratingService->getRating($dto);

        $this->assertEquals(
            Rating::megaKut(),
            $rating,
            'Too much wind should return mega kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturnKutForAlotWind()
    {
        $dto = new WeatherDto();
        $dto->windSpeed = 8.0;

        $rating = $this->ratingService->getRating($dto);

        $this->assertEquals(
            Rating::kut(),
            $rating,
            'A lot of wind should return kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturnBeetjeKutForSomeWind()
    {
        $dto = new WeatherDto();
        $dto->windSpeed = 5.0;

        $rating = $this->ratingService->getRating($dto);

        $this->assertEquals(
            Rating::beetjeKut(),
            $rating,
            'Some wind should return beetje kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturNietKutForLittleWind()
    {
        $dto = new WeatherDto();
        $dto->windSpeed = 3.0;

        $rating = $this->ratingService->getRating($dto);

        $this->assertEquals(
            Rating::nietKut(),
            $rating,
            'Little wind should return niet kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturNietKutForNoWind()
    {
        $dto = new WeatherDto();
        $dto->windSpeed = 0.0;

        $rating = $this->ratingService->getRating($dto);

        $this->assertEquals(
            Rating::nietKut(),
            $rating,
            'No wind should return niet kut rating'
        );
    }

    /**
     * @test
     */
    public function shouldReturnNietKutForUnknownWind()
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
