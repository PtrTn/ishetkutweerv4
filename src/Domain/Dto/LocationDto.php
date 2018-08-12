<?php

namespace App\Domain\Dto;

class LocationDto
{
    /**
     * @var string
     */
    public $region;

    /**
     * @var string
     */
    public $stationName;

    /**
     * @var float
     */
    public $lat;

    /**
     * @var float
     */
    public $lon;
}
