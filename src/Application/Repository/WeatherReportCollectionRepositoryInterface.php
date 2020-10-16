<?php

declare(strict_types=1);

namespace App\Application\Repository;

use App\Domain\Model\WeatherReportCollection;

interface WeatherReportCollectionRepositoryInterface
{
    public function store(WeatherReportCollection $weatherReportCollection): void;

    public function getLatest(): WeatherReportCollection;
}
