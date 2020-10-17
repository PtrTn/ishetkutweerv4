<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;

class VerwachtingDag
{
    /** @Type("string") */
    public string $datum;

    /** @Type("string") */
    public string $dagweek;

    /** @Type("string") */
    public string $kanszon;

    /** @Type("string") */
    public string $kansregen;

    /** @Type("string") */
    public string $minmmregen;

    /** @Type("string") */
    public string $maxmmregen;

    /** @Type("string") */
    public string $mintemp;

    /** @Type("string") */
    public string $mintempmax;

    /** @Type("string") */
    public string $maxtemp;

    /** @Type("string") */
    public string $maxtempmax;

    /** @Type("string") */
    public string $windrichting;

    /** @Type("string") */
    public string $windkracht;

    /** @Type("string") */
    public string $sneeuwcms;
}
