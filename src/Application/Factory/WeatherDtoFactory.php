<?php

namespace App\Application\Factory;

use App\Application\Dto\Buienradar\VerwachtingMeerdaags;
use App\Application\Dto\Buienradar\VerwachtingVandaag;
use App\Application\Dto\Buienradar\WeerstationDto;
use App\Domain\Dto\LocationDto;
use App\Domain\Dto\WeatherDto;

class WeatherDtoFactory implements WeatherDtoFactoryInterface
{
    /**
     * @var ForecastDtoFactory
     */
    private $forecastDtoFactory;

    public function __construct(ForecastDtoFactory $forecastDtoFactory)
    {
        $this->forecastDtoFactory = $forecastDtoFactory;
    }

    public function create(
        VerwachtingVandaag $verwachtingVandaag,
        VerwachtingMeerdaags $verwachtingMeerdaags,
        WeerstationDto $weerstationDto
    ): WeatherDto {
        $dto = new WeatherDto();
        $dto->date = $weerstationDto->datum;
        $dto->temperature = $weerstationDto->temperatuur10cm ?? $weerstationDto->temperatuurGC;
        $dto->windSpeed = $weerstationDto->windsnelheidBF;
        $dto->windDirection = $weerstationDto->windrichting;
        $dto->rain = $weerstationDto->regenMMPU;
        $dto->summary = $verwachtingVandaag->titel;
        $dto->forecast = $this->forecastDtoFactory->create($verwachtingMeerdaags);

        $locationDto = new LocationDto();
        $locationDto->region = $weerstationDto->stationnaam->regio;
        $locationDto->stationName = $weerstationDto->stationnaam->stationnaam;
        $locationDto->lat = $weerstationDto->lat;
        $locationDto->lon = $weerstationDto->lon;
        $dto->location = $locationDto;

        return $dto;
    }
}
