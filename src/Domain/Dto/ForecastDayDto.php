<?php

namespace App\Domain\Dto;

use DateTimeImmutable;

class ForecastDayDto
{
    /**
     * @var DateTimeImmutable
     */
    public $date;

    /**
     * @var float
     */
    public $temperature;
}
