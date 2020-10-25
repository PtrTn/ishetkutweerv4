<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

final class Coordinates
{
    private Latitude $latitude;
    private Longitude $longitude;

    public function __construct(Latitude $latitude, Longitude $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getLatitude(): Latitude
    {
        return $this->latitude;
    }

    public function getLongitude(): Longitude
    {
        return $this->longitude;
    }
}
