<?php

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Type;

class WeergegevensDto
{
    /**
     * @var string
     * @Type("string")
     */
    public $titel;

    /**
     * @var string
     * @Type("string")
     */
    public $link;

    /**
     * @var string
     * @Type("string")
     */
    public $omschrijving;

    /**
     * @var string
     * @Type("string")
     */
    public $language;

    /**
     * @var string
     * @Type("string")
     */
    public $copyright;

    /**
     * @var string
     * @Type("string")
     */
    public $gebruik;

    /**
     * @Exclude
     */
    public $image;

    /**
     * @var WeerstationsDto
     * @Type("App\Infrastructure\Dto\Buienradar\WeerstationsDto")
     */
    public $actueel_weer;

    /**
     * @var VerwachtingMeerdaags
     * @Type("App\Infrastructure\Dto\Buienradar\VerwachtingMeerdaags")
     */
    public $verwachting_meerdaags;


    /**
     * @var VerwachtingVandaag
     * @Type("App\Infrastructure\Dto\Buienradar\VerwachtingVandaag")
     */
    public $verwachting_vandaag;
}
