<?php

namespace App\Infrastructure\Dto\Buienradar;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;

class WeerstationDto
{
    /**
     * @var string|int
     * @Type("string")
     */
    public $stationcode;

    /**
     * @var StationnaamDto
     * @Type("App\Infrastructure\Dto\Buienradar\StationnaamDto")
     */
    public $stationnaam;

    /**
     * @var string|float
     * @Type("string")
     */
    public $lat;

    /**
     * @var string|float
     * @Type("string")
     */
    public $lon;

    /**
     * @var DateTimeImmutable
     * @Type("DateTimeImmutable<'m/d/Y H:i:s'>")
     */
    public $datum;

    /**
     * @var string|int
     * @Type("string")
     */
    public $luchtvochtigheid;

    /**
     * @var string|float
     * @Type("string")
     * @Serializer\SerializedName("temperatuurGC")
     */
    public $temperatuurGC;

    /**
     * @var string|float
     * @Type("string")
     * @Serializer\SerializedName("windsnelheidMS")
     */
    public $windsnelheidMS;

    /**
     * @var string|float
     * @Type("string")
     * @Serializer\SerializedName("windsnelheidBF")
     */
    public $windsnelheidBF;

    /**
     * @var string|int
     * @Type("string")
     * @Serializer\SerializedName("windrichtingGR")
     */
    public $windrichtingGR;

    /**
     * @var string
     * @Type("string")
     */
    public $windrichting;

    /**
     * @var string|float
     * @Type("string")
     */
    public $luchtdruk;

    /**
     * @var string|int
     * @Type("string")
     */
    public $zichtmeters;

    /**
     * @var string|float
     * @Type("string")
     * @Serializer\SerializedName("windstotenMS")
     */
    public $windstotenMS;

    /**
     * @var string|float
     * @Type("string")
     * @Serializer\SerializedName("regenMMPU")
     */
    public $regenMMPU;

    /**
     * @var string|int
     * @Type("string")
     * @Serializer\SerializedName("zonintensiteitWM2")
     */
    public $zonintensiteitWM2;

    /**
     * @var string
     * @Type("string")
     */
    public $icoonactueel;

    /**
     * @var string|float
     * @Type("string")
     */
    public $temperatuur10cm;

    /**
     * @var string
     * @Type("string")
     */
    public $url;

    /**
     * @var string|float
     * @Type("string")
     * @Serializer\SerializedName("latGraden")
     */
    public $latGraden;

    /**
     * @var string|float
     * @Type("string")
     * @Serializer\SerializedName("lonGraden")
     */
    public $lonGraden;
}
