<?php

namespace App\Application\Service;

use App\Domain\Dto\WeatherDto;
use Geokit\LatLng;
use Geokit\Math;

class DistanceService
{
    /**
     * @var Math
     */
    private $math;

    public function __construct(Math $math)
    {
        $this->math = $math;
    }

    /**
     * @param float $targetLat
     * @param float $targetLon
     * @param WeatherDto[] $weatherDtos
     * @return WeatherDto|null
     */
    public function getClosestWeerstation(array $weatherDtos, float $targetLat, float $targetLon): ?WeatherDto
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
            if (!isset($closestDistance) || $distance < $closestDistance) {
                $closestDistance = $distance;
                $closestStation = $dto;
            }
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
