<?php

namespace App\Application\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;

class VerwachtingDag
{
    /**
     * @var string
     * @Type("string")
     */
    public $datum;

    /**
     * @var string
     * @Type("string")
     */
    public $dagweek;

    /**
     * @var string
     * @Type("string")
     */
    public $kanszon;

    /**
     * @var string
     * @Type("string")
     */
    public $kansregen;

    /**
     * @var string
     * @Type("string")
     */
    public $minmmregen;

    /**
     * @var string
     * @Type("string")
     */
    public $maxmmregen;

    /**
     * @var string
     * @Type("string")
     */
    public $mintemp;

    /**
     * @var string
     * @Type("string")
     */
    public $mintempmax;

    /**
     * @var string
     * @Type("string")
     */
    public $maxtemp;

    /**
     * @var string
     * @Type("string")
     */
    public $maxtempmax;

    /**
     * @var string
     * @Type("string")
     */
    public $windrichting;

    /**
     * @var string
     * @Type("string")
     */
    public $windkracht;

    /**
     * @var string
     * @Type("string")
     */
    public $sneeuwcms;
}
