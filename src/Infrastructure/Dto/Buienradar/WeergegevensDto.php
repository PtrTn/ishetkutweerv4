<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;

class WeergegevensDto
{
    /**
     * @var mixed
     * @Type("string")
     */
    public $titel;

    /**
     * @var mixed
     * @Type("string")
     */
    public $link;

    /**
     * @var mixed
     * @Type("string")
     */
    public $omschrijving;

    /**
     * @var mixed
     * @Type("string")
     */
    public $language;

    /**
     * @var mixed
     * @Type("string")
     */
    public $copyright;

    /**
     * @var mixed
     * @Type("string")
     */
    public $gebruik;

    /** @Type("App\Infrastructure\Dto\Buienradar\Image") */
    public Image $image;

    /** @Type("App\Infrastructure\Dto\Buienradar\WeerstationsDto") */
    public WeerstationsDto $actueel_weer;

    /** @Type("App\Infrastructure\Dto\Buienradar\VerwachtingMeerdaags") */
    public VerwachtingMeerdaags $verwachting_meerdaags;

    /** @Type("App\Infrastructure\Dto\Buienradar\VerwachtingVandaag") */
    public VerwachtingVandaag $verwachting_vandaag;
}
