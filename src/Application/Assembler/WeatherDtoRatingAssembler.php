<?php

namespace App\Application\Assembler;

use App\Domain\Dto\WeatherDto;

class WeatherDtoRatingAssembler implements WeatherDtoAssemblerInterface
{
    public function assemble(WeatherDto $dto): WeatherDto
    {
        $dto->rating = 1;
        return $dto;
    }
}
