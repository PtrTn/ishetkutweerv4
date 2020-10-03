<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Dto\WeatherDto;
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

    /**
     * @param WeatherDto[] $weatherDtos
     */
    public function findClosestWeerstation(array $weatherDtos, float $targetLat, float $targetLon): ?WeatherDto
    {
        $closestStation = null;
        $closestDistance = null;
        foreach ($weatherDtos as $dto) {
            $distance = $this->getDistance(
                $targetLat,
                $targetLon,
                floatval($dto->location->lat),
                floatval($dto->location->lon)
            );
            if (isset($closestDistance) && $distance >= $closestDistance) {
                continue;
            }

            $closestDistance = $distance;
            $closestStation = $dto;
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
