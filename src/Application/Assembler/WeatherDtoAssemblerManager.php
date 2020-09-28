<?php

declare(strict_types=1);

namespace App\Application\Assembler;

use App\Domain\Dto\WeatherDto;

class WeatherDtoAssemblerManager implements WeatherDtoAssemblerInterface
{
    /** @var WeatherDtoAssemblerInterface[]|iterable */
    private iterable $assemblers;

    /**
     * @param WeatherDtoAssemblerInterface[]|iterable $assemblers
     */
    public function __construct(iterable $assemblers)
    {
        $this->assemblers = $assemblers;
    }

    public function assemble(WeatherDto $dto): WeatherDto
    {
        foreach ($this->assemblers as $assembler) {
            $dto = $assembler->assemble($dto);
        }

        return $dto;
    }
}
