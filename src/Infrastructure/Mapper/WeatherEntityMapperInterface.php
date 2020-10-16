<?php

declare(strict_types=1);

namespace App\Infrastructure\Mapper;

use App\Domain\Model\WeatherReport;
use App\Infrastructure\Entity\WeatherEntity;

interface WeatherEntityMapperInterface
{
    public function createEntityFromWeatherReport(WeatherReport $weatherReport): WeatherEntity;

    public function createWeatherReportFromEntity(WeatherEntity $entity): WeatherReport;
}
