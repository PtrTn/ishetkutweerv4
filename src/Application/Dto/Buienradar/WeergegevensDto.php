<?php

namespace App\Application\Dto\Buienradar;

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
     * @Type("App\Application\Dto\Buienradar\WeerstationsDto")
     */
    public $actueel_weer;

    /**
     * @var VerwachtingMeerdaags
     * @Type("App\Application\Dto\Buienradar\VerwachtingMeerdaags")
     */
    public $verwachting_meerdaags;


    /**
     * @var VerwachtingVandaag
     * @Type("App\Application\Dto\Buienradar\VerwachtingVandaag")
     */
    public $verwachting_vandaag;
}
