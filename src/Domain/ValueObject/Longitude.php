<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

final class Longitude
{
    private float $longitude;

    public function __construct(float $longitude)
    {
        $this->longitude = $longitude;
    }

    public function toFloat(): float
    {
        return $this->longitude;
    }
}
