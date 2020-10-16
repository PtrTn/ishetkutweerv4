<?php

declare(strict_types=1);

namespace App\Domain\Model;

use DateTimeImmutable;

class ForecastDay
{
    private DateTimeImmutable $date;

    private float $temperature;

    public function __construct(DateTimeImmutable $date, float $temperature)
    {
        $this->date = $date;
        $this->temperature = $temperature;
    }

    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }
}
