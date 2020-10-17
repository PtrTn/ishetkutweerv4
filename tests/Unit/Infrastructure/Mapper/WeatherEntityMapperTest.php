<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Mapper;

use App\Domain\Model\CurrentWeather;
use App\Domain\Model\Description;
use App\Domain\Model\Forecast;
use App\Domain\Model\ForecastDay;
use App\Domain\Model\Location;
use App\Domain\Model\ReportDateTime;
use App\Domain\Model\WeatherRating;
use App\Domain\Model\WeatherReport;
use App\Domain\ValueObject\Rating;
use App\Infrastructure\Entity\WeatherEntity;
use App\Infrastructure\Mapper\WeatherEntityMapper;
use DateTimeImmutable;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class WeatherEntityMapperTest extends MockeryTestCase
{
    private WeatherEntityMapper $mapper;

    public function setUp(): void
    {
        $this->mapper = new WeatherEntityMapper();
    }

    /**
     * @test
     */
    public function shouldCreateEntityFromDto(): void
    {
        $lat = 51.50;
        $lon = 6.20;
        $region = 'Venlo';
        $date = new DateTimeImmutable();
        $temperature = 3.8;
        $rain = 0.5;
        $windSpeed = 1.0;
        $windDirection = 90;
        $kutRating = Rating::kut();
        $summary = 'All is good';

        $locationDto = new Location($region, $lat, $lon);

        $ratingDto = new WeatherRating($kutRating, $kutRating, $kutRating, $kutRating);

        $day1Dto = new ForecastDay(new DateTimeImmutable('+1 day'), 12);
        $day2Dto = new ForecastDay(new DateTimeImmutable('+2 day'), 12);
        $day3Dto = new ForecastDay(new DateTimeImmutable('+3 day'), 12);
        $day4Dto = new ForecastDay(new DateTimeImmutable('+4 day'), 12);
        $day5Dto = new ForecastDay(new DateTimeImmutable('+5 day'), 12);

        $forecastDto = new Forecast($day1Dto, $day2Dto, $day3Dto, $day4Dto, $day5Dto);

        $currentWeather = new CurrentWeather($temperature, $rain, $windSpeed, $windDirection);
        $description = new Description($summary);
        $dateTime = new ReportDateTime($date);

        $weatherReport = new WeatherReport($currentWeather, $description, $forecastDto, $ratingDto, $locationDto, $dateTime);

        $entity = $this->mapper->createEntityFromWeatherReport($weatherReport);

        $this->assertSame($lat, $entity->lat);
        $this->assertSame($lon, $entity->lon);
        $this->assertSame($region, $entity->location);
        $this->assertSame($date, $entity->dateTime);
        $this->assertSame($temperature, $entity->temperature);
        $this->assertSame($rain, $entity->rain);
        $this->assertSame($windSpeed, $entity->windSpeed);
        $this->assertSame($windDirection, $entity->windDirection);
        $this->assertSame($kutRating->getRating(), $entity->temperatureRating);
        $this->assertSame($kutRating->getRating(), $entity->rainRating);
        $this->assertSame($kutRating->getRating(), $entity->windRating);
        $this->assertSame($kutRating->getRating(), $entity->averageRating);
    }

    /**
     * @test
     */
    public function shouldCreateDtoFromEntity(): void
    {
        $lat = 51.50;
        $lon = 6.20;
        $regionName = 'Venlo';
        $date = new DateTimeImmutable();
        $temperature = 3.8;
        $rain = 0.5;
        $windSpeed = 1.1;
        $windDirection = 90;
        $kutRating = 3;
        $description = 'All is good';

        $entity = new WeatherEntity();
        $entity->identifier = 123;
        $entity->location = $regionName;
        $entity->lat = $lat;
        $entity->lon = $lon;
        $entity->dateTime = $date;
        $entity->temperature = $temperature;
        $entity->rain = $rain;
        $entity->windSpeed = $windSpeed;
        $entity->windDirection = $windDirection;
        $entity->temperatureRating = $kutRating;
        $entity->rainRating = $kutRating;
        $entity->windRating = $kutRating;
        $entity->averageRating = $kutRating;
        $entity->description = $description;
        $entity->day1Date = new DateTimeImmutable('+1 day');
        $entity->day1Temp = 12;
        $entity->day2Date = new DateTimeImmutable('+2 days');
        $entity->day2Temp = 12;
        $entity->day3Date = new DateTimeImmutable('+3 days');
        $entity->day3Temp = 12;
        $entity->day4Date = new DateTimeImmutable('+4 days');
        $entity->day4Temp = 12;
        $entity->day5Date = new DateTimeImmutable('+5 days');
        $entity->day5Temp = 12;

        $dto = $this->mapper->createWeatherReportFromEntity($entity);

        $this->assertSame($lat, $dto->getLocation()->getLat());
        $this->assertSame($lon, $dto->getLocation()->getLon());
        $this->assertSame($regionName, $dto->getLocation()->getName());
        $this->assertSame($date, $dto->getDateTime()->toDateTimeImmutable());
        $this->assertSame($temperature, $dto->getCurrentWeather()->getTemperature());
        $this->assertSame($rain, $dto->getCurrentWeather()->getRain());
        $this->assertSame($windSpeed, $dto->getCurrentWeather()->getWindSpeed());
        $this->assertSame($windDirection, $dto->getCurrentWeather()->getWindDirection());
        $this->assertSame($description, $dto->getDescription()->toString());
        $this->assertEquals(new Rating($kutRating), $dto->getRating()->getTemperatureRating());
        $this->assertEquals(new Rating($kutRating), $dto->getRating()->getRainRating());
        $this->assertEquals(new Rating($kutRating), $dto->getRating()->getWindRating());
        $this->assertEquals(new Rating($kutRating), $dto->getRating()->getAverageRating());
    }
}
