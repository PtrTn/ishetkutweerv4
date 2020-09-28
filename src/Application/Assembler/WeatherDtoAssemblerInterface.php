<?php

declare(strict_types=1);

namespace App\Application\Assembler;

use App\Domain\Dto\WeatherDto;

interface WeatherDtoAssemblerInterface
{
    public function assemble(WeatherDto $dto): WeatherDto;
}
