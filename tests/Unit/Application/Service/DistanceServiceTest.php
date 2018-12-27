<?php

namespace App\Tests\Unit\Application\Service;

use App\Application\Service\DistanceService;
use App\Domain\Dto\LocationDto;
use App\Domain\Dto\WeatherDto;
use Geokit\Math;
use PHPUnit\Framework\TestCase;

class DistanceServiceTest extends TestCase
{
    /**
     * @var DistanceService
     */
    private $distanceService;

    public function setUp()
    {
        $this->distanceService = new DistanceService(new Math());
    }

    /**
     * @test
     */
    public function shouldGetClosestStation()
    {
        $weatherDtos = [
            $this->createWeatherDtoForLatLon(51.50, 6.20),
            $this->createWeatherDtoForLatLon(52.07, 5.88),
            $this->createWeatherDtoForLatLon(52.65, 4.98),
        ];
        $weatherDto = $this->distanceService->getClosestWeerstation($weatherDtos, 52.05, 6);

        $this->assertEquals(52.07, $weatherDto->location->lat);
        $this->assertEquals(5.88, $weatherDto->location->lon);
    }

    /**
     * @test
     */
    public function shouldReturnNullIfNoClosestStation()
    {
        $weatherDto = $this->distanceService->getClosestWeerstation([], 52.05, 6);
        $this->assertNull($weatherDto, 'No weather dto expected to be closest, as none were provided');
    }

    private function createWeatherDtoForLatLon(float $lat, float $lon): WeatherDto
    {
        $locationDto = new LocationDto();
        $locationDto->lat = $lat;
        $locationDto->lon = $lon;

        $weatherDto = new WeatherDto();
        $weatherDto->location = $locationDto;

        return $weatherDto;
    }
}
