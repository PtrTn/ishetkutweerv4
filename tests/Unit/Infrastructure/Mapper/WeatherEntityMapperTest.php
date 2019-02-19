<?php

namespace App\Tests\Unit\Infrastructure\ApiClient;

use App\Domain\Dto\ForecastDayDto;
use App\Domain\Dto\ForecastDto;
use App\Domain\Dto\LocationDto;
use App\Domain\Dto\WeatherDto;
use App\Domain\Dto\WeatherRatingDto;
use App\Domain\ValueObject\Rating;
use App\Infrastructure\Entity\WeatherEntity;
use App\Infrastructure\Mapper\WeatherEntityMapper;
use DateTimeImmutable;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class WeatherEntityMapperTest extends MockeryTestCase
{
    /**
     * @var WeatherEntityMapper
     */
    private $mapper;

    public function setUp()
    {
        $this->mapper = new WeatherEntityMapper();
    }

    /**
     * @test
     */
    public function shouldCreateEntityFromDto()
    {
        $lat = 51.50;
        $lon = 6.20;
        $region = 'Venlo';
        $stationName = 'Meetstation Arcen';
        $date = new DateTimeImmutable();
        $temperature = 3.8;
        $rain = 0.5;
        $windSpeed = 1.0;
        $windDirection = 'OZO';
        $background = 'rain.jpg';
        $kutRating = Rating::kut();

        $locationDto = new LocationDto();
        $locationDto->lat = $lat;
        $locationDto->lon = $lon;
        $locationDto->region = $region;
        $locationDto->stationName = $stationName;

        $ratingDto = new WeatherRatingDto();
        $ratingDto->temperatureRating = $kutRating;
        $ratingDto->rainRating = $kutRating;
        $ratingDto->windRating = $kutRating;

        $day1Dto = new ForecastDayDto();
        $day1Dto->temperature = 12;
        $day1Dto->day = 'Ma';

        $day2Dto = new ForecastDayDto();
        $day2Dto->temperature = 12;
        $day2Dto->day = 'Di';

        $day3Dto = new ForecastDayDto();
        $day3Dto->temperature = 12;
        $day3Dto->day = 'Wo';

        $day4Dto = new ForecastDayDto();
        $day4Dto->temperature = 12;
        $day4Dto->day = 'Do';

        $day5Dto = new ForecastDayDto();
        $day5Dto->temperature = 12;
        $day5Dto->day = 'Vr';

        $forecastDto = new ForecastDto();
        $forecastDto->day1 = $day1Dto;
        $forecastDto->day2 = $day2Dto;
        $forecastDto->day3 = $day3Dto;
        $forecastDto->day4 = $day4Dto;
        $forecastDto->day5 = $day5Dto;

        $dto = new WeatherDto();
        $dto->location = $locationDto;
        $dto->date = $date;
        $dto->temperature = $temperature;
        $dto->rain = $rain;
        $dto->windSpeed = $windSpeed;
        $dto->windDirection = $windDirection;
        $dto->rating = $ratingDto;
        $dto->background = $background;
        $dto->forecast = $forecastDto;

        $entity = $this->mapper->createEntityFromDto($dto);

        $this->assertSame($lat, $entity->lat);
        $this->assertSame($lon, $entity->lon);
        $this->assertSame($region, $entity->region);
        $this->assertSame($stationName, $entity->stationName);
        $this->assertSame($date, $entity->date);
        $this->assertSame($temperature, $entity->temperature);
        $this->assertSame($rain, $entity->rain);
        $this->assertSame($windSpeed, $entity->windSpeed);
        $this->assertSame($windDirection, $entity->windDirection);
        $this->assertSame($background, $entity->background);
        $this->assertSame($kutRating->getRating(), $entity->temperatureRating);
        $this->assertSame($kutRating->getRating(), $entity->rainRating);
        $this->assertSame($kutRating->getRating(), $entity->windRating);
    }

    /**
     * @test
     */
    public function shouldCreateDtoFromEntity()
    {
        $lat = 51.50;
        $lon = 6.20;
        $region = 'Venlo';
        $stationName = 'Meetstation Arcen';
        $date = new DateTimeImmutable();
        $temperature = 3.8;
        $rain = 0.5;
        $windSpeed = 1.0;
        $windDirection = 'OZO';
        $background = 'rain.jpg';
        $kutRating = 3;

        $entity = new WeatherEntity();
        $entity->id = 123;
        $entity->region = $region;
        $entity->stationName = $stationName;
        $entity->lat = $lat;
        $entity->lon = $lon;
        $entity->date = $date;
        $entity->temperature = $temperature;
        $entity->rain = $rain;
        $entity->windSpeed = $windSpeed;
        $entity->windDirection = $windDirection;
        $entity->temperatureRating = $kutRating;
        $entity->rainRating = $kutRating;
        $entity->windRating = $kutRating;
        $entity->background = $background;
        
        $dto = $this->mapper->createDtoFromEntity($entity);

        $this->assertSame($lat, $dto->location->lat);
        $this->assertSame($lon, $dto->location->lon);
        $this->assertSame($region, $dto->location->region);
        $this->assertSame($stationName, $dto->location->stationName);
        $this->assertSame($date, $dto->date);
        $this->assertSame($temperature, $dto->temperature);
        $this->assertSame($rain, $dto->rain);
        $this->assertSame($windSpeed, $dto->windSpeed);
        $this->assertSame($windDirection, $dto->windDirection);
        $this->assertSame($background, $dto->background);
        $this->assertEquals(new Rating($kutRating), $dto->rating->temperatureRating);
        $this->assertEquals(new Rating($kutRating), $dto->rating->rainRating);
        $this->assertEquals(new Rating($kutRating), $dto->rating->windRating);
    }

}
