<?php

namespace App\Application\Assembler;

use App\Domain\Dto\WeatherDto;

interface WeatherDtoAssemblerInterface
{
    public function assemble(WeatherDto $dto): WeatherDto;
}
