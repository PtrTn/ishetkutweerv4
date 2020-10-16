<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Model\WeatherReportCollection;
use App\Infrastructure\Dto\Buienradar\BuienradarnlDto;

interface WeatherReportCollectionFactoryInterface
{
    public function create(BuienradarnlDto $buienradarnlDto): WeatherReportCollection;
}
