<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Service;

use App\Application\Service\DistanceService;
use App\Domain\Model\CurrentWeather;
use App\Domain\Model\Description;
use App\Domain\Model\Forecast;
use App\Domain\Model\ForecastDay;
use App\Domain\Model\Location;
use App\Domain\Model\ReportDateTime;
use App\Domain\Model\WeatherRating;
use App\Domain\Model\WeatherReport;
use App\Domain\Model\WeatherReportCollection;
use App\Domain\ValueObject\Rating;
use DateTimeImmutable;
use Geokit\Math;
use PHPUnit\Framework\TestCase;

class DistanceServiceTest extends TestCase
{
    private DistanceService $distanceService;

    public function setUp(): void
    {
        $this->distanceService = new DistanceService(new Math());
    }

    /**
     * @test
     */
    public function shouldGetClosestStation(): void
    {
        $weatherReportCollection = new WeatherReportCollection([
            $this->createWeatherDtoForLatLon(51.50, 6.20),
            $this->createWeatherDtoForLatLon(52.07, 5.88),
            $this->createWeatherDtoForLatLon(52.65, 4.98),
        ]);
        $weatherDto = $this->distanceService->findClosestWeatherReport($weatherReportCollection, 52.05, 6);

        $this->assertEquals(52.07, $weatherDto->getLocation()->getLat());
        $this->assertEquals(5.88, $weatherDto->getLocation()->getLon());
    }

    /**
     * @test
     */
    public function shouldReturnNullIfNoClosestStation(): void
    {
        $weatherDto = $this->distanceService->findClosestWeatherReport(new WeatherReportCollection([]), 52.05, 6);
        $this->assertNull($weatherDto, 'No weather dto expected to be closest, as none were provided');
    }

    private function createWeatherDtoForLatLon(float $lat, float $lon): WeatherReport
    {
        return new WeatherReport(
            new CurrentWeather(
                3.8,
                0.5,
                1.1,
                270,
            ),
            new Description('ALl is good'),
            new Forecast(
                new ForecastDay(new DateTimeImmutable('+1 day'), 5),
                new ForecastDay(new DateTimeImmutable('+2 days'), 5),
                new ForecastDay(new DateTimeImmutable('+3 days'), 5),
                new ForecastDay(new DateTimeImmutable('+4 days'), 5),
                new ForecastDay(new DateTimeImmutable('+5 days'), 5),
            ),
            new WeatherRating(
                new Rating(Rating::BEETJE_KUT),
                new Rating(Rating::BEETJE_KUT),
                new Rating(Rating::BEETJE_KUT),
                new Rating(Rating::BEETJE_KUT)
            ),
            new Location('Venlo', $lat, $lon),
            new ReportDateTime(new DateTimeImmutable()),
        );
    }
}
