<?php

namespace App\Tests\Unit\Application\Factory;

use App\Application\Dto\Buienradar\StationnaamDto;
use App\Application\Dto\Buienradar\VerwachtingDag;
use App\Application\Dto\Buienradar\VerwachtingMeerdaags;
use App\Application\Dto\Buienradar\VerwachtingVandaag;
use App\Application\Dto\Buienradar\WeerstationDto;
use App\Application\Factory\ForecastDtoFactory;
use App\Application\Factory\WeatherDtoFactory;
use App\Application\Service\DateTimeImmutableFactory;
use App\Domain\Dto\ForecastDto;
use Mockery;
use PHPUnit\Framework\TestCase;

class WeatherDtoFactoryTest extends TestCase
{
    /**
     * @var WeatherDtoFactory
     */
    private $factory;

    public function setUp()
    {
        $forecastDtoFactory = Mockery::mock(ForecastDtoFactory::class, [
            'create' => new ForecastDto()
        ]);
        $this->factory = new WeatherDtoFactory($forecastDtoFactory);
    }

    /**
     * @test
     */
    public function shouldCreateWeatherDtoFromDtos()
    {
        $region = 'Venlo';
        $station = 'Meetstation Arcen';
        $temperature = '11.3';
        $windspeed = '2';
        $windDirection = 'NO';
        $rain = '0.5';
        $lat = '51.50';
        $lon = '6.20';

        $stationnaamDto = new StationnaamDto();
        $stationnaamDto->regio = $region;
        $stationnaamDto->stationnaam = $station;

        $weerstationDto = new WeerstationDto();
        $weerstationDto->datum = new \DateTimeImmutable();
        $weerstationDto->temperatuur10cm = $temperature;
        $weerstationDto->windsnelheidBF = $windspeed;
        $weerstationDto->windrichting = $windDirection;
        $weerstationDto->regenMMPU = $rain;
        $weerstationDto->lat = $lat;
        $weerstationDto->lon = $lon;
        $weerstationDto->stationnaam = $stationnaamDto;

        $verwachtingMeerdaags = new VerwachtingMeerdaags();
        $verwachtingMeerdaags->dagPlus1 = new VerwachtingDag();
        $verwachtingMeerdaags->dagPlus2 = new VerwachtingDag();
        $verwachtingMeerdaags->dagPlus3 = new VerwachtingDag();
        $verwachtingMeerdaags->dagPlus4 = new VerwachtingDag();
        $verwachtingMeerdaags->dagPlus5 = new VerwachtingDag();

        $verwachtingVandaag = new VerwachtingVandaag();

        $weatherDto = $this->factory->create(
            $verwachtingVandaag,
            $verwachtingMeerdaags,
            $weerstationDto
        );

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
