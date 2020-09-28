<?php

declare(strict_types=1);

namespace App\Domain\Dto;

class ForecastDto
{
    public ForecastDayDto $day1;

    public ForecastDayDto $day2;

    public ForecastDayDto $day3;

    public ForecastDayDto $day4;

    public ForecastDayDto $day5;
}
