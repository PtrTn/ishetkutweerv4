<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Model\CurrentWeather;
use App\Infrastructure\Dto\Buienradar\WeerstationDto;
use InvalidArgumentException;

use function floatval;
use function intval;

class CurrentWeatherFactory
{
    public function create(WeerstationDto $weerstationDto): CurrentWeather
    {
        return new CurrentWeather(
            $this->getTemperature($weerstationDto),
            $this->getRain($weerstationDto),
            $this->getWindspeed($weerstationDto),
            $this->getWindDirection($weerstationDto),
        );
    }

    private function getTemperature(WeerstationDto $weerstationDto): float
    {
        if ($weerstationDto->temperatuurGC !== '-') {
            return floatval($weerstationDto->temperatuurGC);
        }

        if ($weerstationDto->temperatuur10cm !== '-') {
            return floatval($weerstationDto->temperatuur10cm);
        }

        throw new InvalidArgumentException('Missing data');
    }

    private function getRain(WeerstationDto $weerstationDto): float
    {
        if ($weerstationDto->regenMMPU === '-') {
            return floatval($weerstationDto->regenMMPU);
        }

        throw new InvalidArgumentException('Missing data');
    }

    private function getWindspeed(WeerstationDto $weerstationDto): float
    {
        if ($weerstationDto->windsnelheidBF === '-') {
            throw new InvalidArgumentException('Missing data');
        }

        return floatval($weerstationDto->windsnelheidBF);
    }

    private function getWindDirection(WeerstationDto $weerstationDto): int
    {
        if ($weerstationDto->windrichtingGR === '-') {
            throw new InvalidArgumentException('Missing data');
        }

        return intval($weerstationDto->windrichtingGR);
    }
}
