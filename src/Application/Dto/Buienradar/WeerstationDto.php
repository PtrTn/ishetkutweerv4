<?php

namespace App\Application\Dto\Buienradar;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;

class WeerstationDto
{
    /**
     * @var string
     * @Type("string")
     */
    public $stationcode;

    /**
     * @var StationnaamDto
     * @Type("App\Application\Dto\Buienradar\StationnaamDto")
     */
    public $stationnaam;

    /**
     * @var string
     * @Type("string")
     */
    public $lat;

    /**
     * @var string
     * @Type("string")
     */
    public $lon;

    /**
     * @var DateTimeImmutable
     * @Type("DateTimeImmutable<'m/d/Y H:i:s'>")
     */
    public $datum;

    /**
     * @var string
     * @Type("string")
     */
    public $luchtvochtigheid;

    /**
     * @var string
     * @Type("string")
     * @Serializer\SerializedName("temperatuurGC")
     */
    public $temperatuurGC;

    /**
     * @var string
     * @Type("string")
     * @Serializer\SerializedName("windsnelheidMS")
     */
    public $windsnelheidMS;

    /**
     * @var string
     * @Type("string")
     * @Serializer\SerializedName("windsnelheidBF")
     */
    public $windsnelheidBF;

    /**
     * @var string
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
     * @var string
     * @Type("string")
     */
    public $luchtdruk;

    /**
     * @var string
     * @Type("string")
     */
    public $zichtmeters;

    /**
     * @var string
     * @Type("string")
     * @Serializer\SerializedName("windstotenMS")
     */
    public $windstotenMS;

    /**
     * @var string
     * @Type("string")
     * @Serializer\SerializedName("regenMMPU")
     */
    public $regenMMPU;

    /**
     * @var string
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
     * @var string
     * @Type("string")
     */
    public $temperatuur10cm;

    /**
     * @var string
     * @Type("string")
     */
    public $url;

    /**
     * @var string
     * @Type("string")
     * @Serializer\SerializedName("latGraden")
     */
    public $latGraden;

    /**
     * @var string
     * @Type("string")
     * @Serializer\SerializedName("lonGraden")
     */
    public $lonGraden;
}
