<?php

declare(strict_types=1);

namespace App\Domain\Model;

class Forecast
{
    private ForecastDay $day1;

    private ForecastDay $day2;

    private ForecastDay $day3;

    private ForecastDay $day4;

    private ForecastDay $day5;

    public function __construct(
        ForecastDay $day1,
        ForecastDay $day2,
        ForecastDay $day3,
        ForecastDay $day4,
        ForecastDay $day5
    ) {
        $this->day1 = $day1;
        $this->day2 = $day2;
        $this->day3 = $day3;
        $this->day4 = $day4;
        $this->day5 = $day5;
    }

    public function getDay1(): ForecastDay
    {
        return $this->day1;
    }

    public function getDay2(): ForecastDay
    {
        return $this->day2;
    }

    public function getDay3(): ForecastDay
    {
        return $this->day3;
    }

    public function getDay4(): ForecastDay
    {
        return $this->day4;
    }

    public function getDay5(): ForecastDay
    {
        return $this->day5;
    }
}
