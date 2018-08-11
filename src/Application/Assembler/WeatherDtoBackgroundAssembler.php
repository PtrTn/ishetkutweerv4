<?php

namespace App\Application\Assembler;

use App\Domain\Dto\WeatherDto;

class WeatherDtoBackgroundAssembler implements WeatherDtoAssemblerInterface
{
    public function assemble(WeatherDto $dto): WeatherDto
    {
        $dto->background = 'rain.jpg';
        return $dto;
    }
}
