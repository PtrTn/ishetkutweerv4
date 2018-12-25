<?php

namespace App\Tests\Unit\Application\Factory;

use App\Application\Dto\Buienradar\StationnaamDto;
use App\Application\Dto\Buienradar\WeerstationDto;
use App\Application\Factory\WeatherDtoFactory;
use PHPUnit\Framework\TestCase;

class WeatherDtoFactoryTest extends TestCase
{
    /**
     * @var WeatherDtoFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new WeatherDtoFactory();
    }

    /**
     * @test
     */
    public function shouldCreateWeatherDtoFromWeerstationDto()
    {
        $region = 'Venlo';
        $station = 'Meetstation Arcen';
        $temperature = '11.3';
        $windspeed = '2';
        $windDirection = 'NO';
        $rain = '0.5';
        $lat = '51.50';
        $lon = '6.20';

        $weerstationDto = new WeerstationDto();
        $weerstationDto->datum = new \DateTimeImmutable();
        $weerstationDto->temperatuur10cm = $temperature;
        $weerstationDto->windsnelheidBF = $windspeed;
        $weerstationDto->windrichting = $windDirection;
        $weerstationDto->regenMMPU = $rain;
        $weerstationDto->lat = $lat;
        $weerstationDto->lon = $lon;

        $stationnaamDto = new StationnaamDto();
        $stationnaamDto->regio = $region;
        $stationnaamDto->stationnaam = $station;
        $weerstationDto->stationnaam = $stationnaamDto;

        $weatherDto = $this->factory->createFromWeerstationDto($weerstationDto);

        $this->assertEquals($temperature, $weatherDto->temperature);
        $this->assertEquals($windspeed, $weatherDto->windSpeed);
        $this->assertEquals($windDirection, $weatherDto->windDirection);
        $this->assertEquals($rain, $weatherDto->rain);
        $this->assertEquals($lat, $weatherDto->location->lat);
        $this->assertEquals($lon, $weatherDto->location->lon);
        $this->assertEquals($region, $weatherDto->location->region);
        $this->assertEquals($station, $weatherDto->location->stationName);
    }
}
