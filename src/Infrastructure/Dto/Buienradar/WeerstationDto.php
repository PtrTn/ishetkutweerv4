<?php

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;

class WeerstationDto
{
    /**
     * @Type("string")
     */
    public $stationcode;

    /**
     * @Type("string")
     */
    public $stationnaam;

    /**
     * @Type("float")
     */
    public $lat;

    /**
     * @Type("float")
     */
    public $lon;

    /**
     * @Type("DateTimeImmutable<'m/d/Y H:i:s'>")
     */
    public $datum;

    /**
     * @Type("integer")
     */
    public $luchtvochtigheid;

    /**
     * @Type("float")
     */
    public $temperatuurGC;

    /**
     * @Type("float")
     */
    public $windsnelheidMS;

    /**
     * @Type("integer")
     */
    public $windsnelheidBF;

    /**
     * @Type("integer")
     */
    public $windrichtingGR;

    /**
     * @Type("string")
     */
    public $windrichting;

    /**
     * @Type("string")
     */
    public $luchtdruk;

    /**
     * @Type("string")
     */
    public $zichtmeters;

    /**
     * @Type("string")
     */
    public $windstotenMS;

    /**
     * @Type("string")
     */
    public $regenMMPU;

    /**
     * @Type("string")
     */
    public $zonintensiteitWM2;

    /**
     * @Type("string")
     */
    public $icoonactueel;

    /**
     * @Type("string")
     */
    public $temperatuur10cm;

    /**
     * @Type("string")
     */
    public $url;

    /**
     * @Type("float")
     */
    public $latGraden;

    /**
     * @Type("float")
     */
    public $lonGraden;
}
