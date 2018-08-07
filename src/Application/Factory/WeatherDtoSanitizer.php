<?php

namespace App\Application\Factory;

use App\Application\Dto\Buienradar\WeerstationDto;
use App\Domain\Dto\WeatherDto;

class WeatherDtoSanitizer implements WeatherDtoFactoryInterface
{
    /**
     * @var WeatherDtoFactoryInterface
     */
    private $factory;

    public function __construct(WeatherDtoFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createFromWeerstationDto(WeerstationDto $dto): WeatherDto
    {
        $dto = $this->sanitizeWeerstationDto($dto);
        return $this->factory->createFromWeerstationDto($dto);
    }

    private function sanitizeWeerstationDto(WeerstationDto $dto)
    {
        $dto->stationcode = $this->stringToInt($dto->stationcode);
        $dto->lat = $this->stringToFloat($dto->lat);
        $dto->lon = $this->stringToFloat($dto->lon);
        $dto->luchtvochtigheid = $this->stringToInt($dto->luchtvochtigheid);
        $dto->temperatuurGC = $this->stringToFloat($dto->temperatuurGC);
        $dto->windsnelheidMS = $this->stringToFloat($dto->windsnelheidMS);
        $dto->windsnelheidBF = $this->stringToFloat($dto->windsnelheidBF);
        $dto->windrichtingGR = $this->stringToInt($dto->windrichtingGR);
        $dto->luchtdruk = $this->stringToFloat($dto->luchtdruk);
        $dto->zichtmeters = $this->stringToInt($dto->zichtmeters);
        $dto->windstotenMS = $this->stringToFloat($dto->windstotenMS);
        $dto->regenMMPU = $this->stringToFloat($dto->regenMMPU);
        $dto->zonintensiteitWM2 = $this->stringToInt($dto->zonintensiteitWM2);
        $dto->temperatuur10cm = $this->stringToFloat($dto->temperatuur10cm);
        $dto->latGraden = $this->stringToFloat($dto->latGraden);
        $dto->lonGraden = $this->stringToFloat($dto->lonGraden);
        return $dto;
    }

    private function stringToInt(string $string): ?int {
        if ($string === '-') {
            return null;
        }
        return intval($string);
    }

    private function stringToFloat(string $string): ?float {
        if ($string === '-') {
            return null;
        }
        return floatval($string);
    }
}
