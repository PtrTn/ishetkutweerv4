<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Model\WeatherReport;
use App\Domain\Model\WeatherReportCollection;
use Geokit\LatLng;
use Geokit\Math;

use function floatval;

class DistanceService
{
    private Math $math;

    public function __construct(Math $math)
    {
        $this->math = $math;
    }

    public function findClosestWeatherReport(WeatherReportCollection $weatherReports, float $targetLat, float $targetLon): ?WeatherReport
    {
        $closestStation = null;
        $closestDistance = null;
        foreach ($weatherReports->toArray() as $weatherReport) {
            $distance = $this->getDistance(
                $targetLat,
                $targetLon,
                floatval($weatherReport->getLocation()->getLat()),
                floatval($weatherReport->getLocation()->getLon())
            );
            if (isset($closestDistance) && $distance >= $closestDistance) {
                continue;
            }

            $closestDistance = $distance;
            $closestStation = $weatherReport;
        }

        return $closestStation;
    }

    private function getDistance(float $latA, float $lonA, float $latB, float $lonB): float
    {
        $distance = $this->math->distanceHaversine(
            new LatLng($latA, $lonA),
            new LatLng($latB, $lonB)
        );

        return $distance->kilometers();
    }
}
