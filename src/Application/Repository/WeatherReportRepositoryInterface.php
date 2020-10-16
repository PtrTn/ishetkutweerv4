<?php

declare(strict_types=1);

namespace App\Application\Repository;

use App\Domain\Model\WeatherReport;

interface WeatherReportRepositoryInterface
{
    public function getLatestWeatherReportForLocation(string $location): ?WeatherReport;
}
