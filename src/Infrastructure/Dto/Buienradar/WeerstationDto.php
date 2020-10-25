<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto\Buienradar;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;

/**
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class WeerstationDto
{
    /**
     * @var mixed
     * @Type("string")
     */
    public $stationcode;

    /** @Type("App\Infrastructure\Dto\Buienradar\StationnaamDto") */
    public StationnaamDto $stationnaam;

    /**
     * @var mixed
     * @Type("string")
     */
    public $lat;

    /**
     * @var mixed
     * @Type("string")
     */
    public $lon;

    /** @Type("DateTimeImmutable<'m/d/Y H:i:s'>") */
    public DateTimeImmutable $datum;

    /**
     * @var mixed
     * @Type("string")
     */
    public $luchtvochtigheid;

    /**
     * @var mixed
     * @Type("string")
     * @Serializer\SerializedName("temperatuurGC")
     */
    public $temperatuurGC;

    /**
     * @var mixed
     * @Type("string")
     * @Serializer\SerializedName("windsnelheidMS")
     */
    public $windsnelheidMS;

    /**
     * @var mixed
     * @Type("string")
     * @Serializer\SerializedName("windsnelheidBF")
     */
    public $windsnelheidBF;

    /**
     * @var mixed
     * @Type("string")
     * @Serializer\SerializedName("windrichtingGR")
     */
    public $windrichtingGR;

    /** @Type("string") */
    public string $windrichting;

    /**
     * @var mixed
     * @Type("string")
     */
    public $luchtdruk;

    /**
     * @var mixed
     * @Type("string")
     */
    public $zichtmeters;

    /**
     * @var mixed
     * @Type("string")
     * @Serializer\SerializedName("windstotenMS")
     */
    public $windstotenMS;

    /**
     * @var mixed
     * @Type("string")
     * @Serializer\SerializedName("regenMMPU")
     */
    public $regenMMPU;

    /**
     * @var mixed
     * @Type("string")
     * @Serializer\SerializedName("zonintensiteitWM2")
     */
    public $zonintensiteitWM2;

    /** @Type("string") */
    public string $icoonactueel;

    /**
     * @var mixed
     * @Type("string")
     */
    public $temperatuur10cm;

    /**
     * @var mixed
     * @Type("string")
     */
    public $url;

    /**
     * @var mixed
     * @Type("string")
     * @Serializer\SerializedName("latGraden")
     */
    public $latGraden;

    /**
     * @var mixed
     * @Type("string")
     * @Serializer\SerializedName("lonGraden")
     */
    public $lonGraden;
}
