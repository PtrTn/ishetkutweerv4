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
        $dto->temperature = $this->stringToFloat($weerstationDto->temperatuur10cm);
        $dto->windSpeed = $this->stringToFloat($weerstationDto->windsnelheidBF);
        $dto->windDirection = $weerstationDto->windrichting;
        $dto->rain = $this->stringToFloat($weerstationDto->regenMMPU);
        return $dto;
    }

    private function stringToFloat(string $string): ?float {
        if ($string === '-') {
            return null;
        }
        return floatval($string);
    }
}
