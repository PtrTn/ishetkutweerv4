<?php

declare(strict_types=1);

namespace App\Application\Repository;

use App\Domain\Model\WeatherReportCollection;

interface WeatherRepositoryInterface
{
    public function fetchWeather(): WeatherReportCollection;
}
