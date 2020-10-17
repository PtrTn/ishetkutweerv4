<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;

class WeergegevensDto
{
    /** @Type("string") */
    public string $titel;

    /** @Type("string") */
    public string $link;

    /** @Type("string") */
    public string $omschrijving;

    /** @Type("string") */
    public string $language;

    /** @Type("string") */
    public string $copyright;

    /** @Type("string") */
    public string $gebruik;

    /** @Type("App\Infrastructure\Dto\Buienradar\Image") */
    public Image $image;

    /** @Type("App\Infrastructure\Dto\Buienradar\WeerstationsDto") */
    public WeerstationsDto $actueel_weer;

    /** @Type("App\Infrastructure\Dto\Buienradar\VerwachtingMeerdaags") */
    public VerwachtingMeerdaags $verwachting_meerdaags;

    /** @Type("App\Infrastructure\Dto\Buienradar\VerwachtingVandaag") */
    public VerwachtingVandaag $verwachting_vandaag;
}
