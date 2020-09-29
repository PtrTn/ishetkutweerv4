<?php

declare(strict_types=1);

namespace App\Domain\Dto;

use DateTimeImmutable;

class ForecastDayDto
{
    public DateTimeImmutable $date;

    public float $temperature;
}
