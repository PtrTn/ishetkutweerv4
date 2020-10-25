<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

final class Latitude
{
    private float $latitude;

    public function __construct(float $latitude)
    {
        $this->latitude = $latitude;
    }

    public function toFloat(): float
    {
        return $this->latitude;
    }
}
