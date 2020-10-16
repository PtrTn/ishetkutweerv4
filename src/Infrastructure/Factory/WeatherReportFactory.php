<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Model\CurrentWeather;
use App\Domain\Model\Description;
use App\Domain\Model\Location;
use App\Domain\Model\ReportDateTime;
use App\Domain\Model\WeatherReport;
use App\Infrastructure\Dto\Buienradar\VerwachtingMeerdaags;
use App\Infrastructure\Dto\Buienradar\VerwachtingVandaag;
use App\Infrastructure\Dto\Buienradar\WeerstationDto;
use InvalidArgumentException;

use function floatval;
use function intval;

class WeatherReportFactory
{
    private ForecastFactory $forecastFactory;
    private WeatherRatingFactory $weatherRatingFactory;

    public function __construct(
        ForecastFactory $forecastDtoFactory,
        WeatherRatingFactory $weatherRatingDtoFactory
    ) {
        $this->forecastFactory = $forecastDtoFactory;
        $this->weatherRatingFactory = $weatherRatingDtoFactory;
    }

    public function create(
        VerwachtingVandaag $verwachtingVandaag,
        VerwachtingMeerdaags $verwachtingMeerdaags,
        WeerstationDto $weerstationDto
    ): WeatherReport {
        $temperature = '-';
        if ($weerstationDto->temperatuurGC !== '-') {
            $temperature = $weerstationDto->temperatuurGC;
        }

        if ($weerstationDto->temperatuur10cm !== '-') {
            $temperature = $weerstationDto->temperatuur10cm;
        }

        $rain = 0;
        if ($weerstationDto->regenMMPU !== '-') {
            $rain = $this->stringToFloat($weerstationDto->regenMMPU);
        }

        $currentWeather = new CurrentWeather(
            $this->stringToFloat($temperature),
            $rain,
            $this->stringToFloat($weerstationDto->windsnelheidBF),
            $this->stringToInt($weerstationDto->windrichtingGR),
        );

        $description = new Description($verwachtingVandaag->titel);
        $forecast = $this->forecastFactory->create($verwachtingMeerdaags);
        $rating = $this->weatherRatingFactory->create($currentWeather);
        $location = new Location(
            $weerstationDto->stationnaam->regio,
            $this->stringToFloat($weerstationDto->lat),
            $this->stringToFloat($weerstationDto->lon)
        );
        $dateTime = new ReportDateTime($weerstationDto->datum);

        return new WeatherReport(
            $currentWeather,
            $description,
            $forecast,
            $rating,
            $location,
            $dateTime,
        );
    }

    private function stringToInt(string $string): int
    {
        if ($string === '-') {
            throw new InvalidArgumentException('Missing data');
        }

        return intval($string);
    }

    private function stringToFloat(string $string): float
    {
        if ($string === '-') {
            throw new InvalidArgumentException('Missing data');
        }

        return floatval($string);
    }
}
