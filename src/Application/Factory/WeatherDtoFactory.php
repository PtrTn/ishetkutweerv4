<?php

namespace App\Application\Factory;

use App\Application\Dto\Buienradar\WeerstationDto;
use App\Domain\Dto\LocationDto;
use App\Domain\Dto\WeatherDto;

class WeatherDtoFactory implements WeatherDtoFactoryInterface
{
    public function createFromWeerstationDto(WeerstationDto $weerstationDto): WeatherDto
    {
        $dto = new WeatherDto();
        $dto->date = $weerstationDto->datum;
        $dto->temperature = $weerstationDto->temperatuur10cm;
        $dto->windSpeed = $weerstationDto->windsnelheidBF;
        $dto->windDirection = $weerstationDto->windrichting;
        $dto->rain = $weerstationDto->regenMMPU;

        $locationDto = new LocationDto();
        $locationDto->region = $weerstationDto->stationnaam->regio;
        $locationDto->stationName = $weerstationDto->stationnaam->regio;
        $locationDto->lat = $weerstationDto->lat;
        $locationDto->lon = $weerstationDto->lon;
        $dto->location = $locationDto;

        return $dto;
    }
}
