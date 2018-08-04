<?php

namespace App\Application\Service;


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

    public function getDistance(float $latA, float $lonA, float $latB, float $lonB): float
    {
        $distance = $this->math->distanceHaversine(
            new LatLng($latA, $lonA),
            new LatLng($latB, $lonB)
        );
        return $distance->kilometers();
    }
}
