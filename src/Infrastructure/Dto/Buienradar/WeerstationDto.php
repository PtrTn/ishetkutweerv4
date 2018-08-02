<?php

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;

class WeerstationDto
{
    /**
     * @Type("string")
     * @XmlAttribute
     */
    public $id;

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
     * @Serializer\SerializedName("temperatuurGC")
     */
    public $temperatuurGC;

    /**
     * @Type("float")
     * @Serializer\SerializedName("windsnelheidMS")
     */
    public $windsnelheidMS;

    /**
     * @Type("integer")
     * @Serializer\SerializedName("windsnelheidBF")
     */
    public $windsnelheidBF;

    /**
     * @Type("integer")
     * @Serializer\SerializedName("windrichtingGR")
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
     * @Serializer\SerializedName("latGraden")
     */
    public $latGraden;

    /**
     * @Type("float")
     * @Serializer\SerializedName("lonGraden")
     */
    public $lonGraden;
}
