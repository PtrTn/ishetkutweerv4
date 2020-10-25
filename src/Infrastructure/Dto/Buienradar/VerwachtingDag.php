<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;

class VerwachtingDag
{
    /**
     * @var mixed
     * @Type("string")
     */
    public $datum;

    /**
     * @var mixed
     * @Type("string")
     */
    public $dagweek;

    /**
     * @var mixed
     * @Type("string")
     */
    public $kanszon;

    /**
     * @var mixed
     * @Type("string")
     */
    public $kansregen;

    /**
     * @var mixed
     * @Type("string")
     */
    public $minmmregen;

    /**
     * @var mixed
     * @Type("string")
     */
    public $maxmmregen;

    /**
     * @var mixed
     * @Type("string")
     */
    public $mintemp;

    /**
     * @var mixed
     * @Type("string")
     */
    public $mintempmax;

    /**
     * @var mixed
     * @Type("string")
     */
    public $maxtemp;

    /**
     * @var mixed
     * @Type("string")
     */
    public $maxtempmax;

    /**
     * @var mixed
     * @Type("string")
     */
    public $windrichting;

    /**
     * @var mixed
     * @Type("string")
     */
    public $windkracht;

    /**
     * @var mixed
     * @Type("string")
     */
    public $sneeuwcms;
}
