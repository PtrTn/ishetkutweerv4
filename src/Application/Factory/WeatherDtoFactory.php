<?php

namespace App\Application\Factory;

use App\Application\Dto\Buienradar\WeerstationDto;
use App\Domain\Dto\WeatherDto;

class WeatherDtoFactory implements WeatherDtoFactoryInterface
{
    public function createFromWeerstationDto(WeerstationDto $weerstationDto): WeatherDto
    {
        $dto = new WeatherDto();
        $dto->location = $weerstationDto->stationnaam->regio;
        $dto->date = $weerstationDto->datum;
        $dto->temperature = $weerstationDto->temperatuur10cm;
        $dto->windSpeed = $weerstationDto->windsnelheidBF;
        $dto->windDirection = $weerstationDto->windrichting;
        $dto->rain = $weerstationDto->regenMMPU;
        return $dto;
    }
}
