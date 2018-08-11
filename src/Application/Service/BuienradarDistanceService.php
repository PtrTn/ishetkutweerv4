<?php

namespace App\Application\Service;

use App\Application\Dto\Buienradar\BuienradarnlDto;
use App\Application\Dto\Buienradar\WeerstationDto;
use Geokit\LatLng;
use Geokit\Math;

class BuienradarDistanceService
{
    /**
     * @var Math
     */
    private $math;

    public function __construct(Math $math)
    {
        $this->math = $math;
    }

    public function getClosestWeerstation(float $latA, float $lonA, BuienradarnlDto $data): ?WeerstationDto
    {
        $closestStation = null;
        $closestDistance = null;
        foreach ($data->weergegevens->actueel_weer->weerstations as $weerstation) {
            $distance = $this->getDistance(
                $latA,
                $lonA,
                floatval($weerstation->lat),
                floatval($weerstation->lon)
            );
            if (!isset($closestDistance) || $distance < $closestDistance) {
                $closestDistance = $distance;
                $closestStation = $weerstation;
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
