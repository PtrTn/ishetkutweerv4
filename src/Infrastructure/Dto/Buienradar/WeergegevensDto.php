<?php

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Type;

class WeergegevensDto
{
    /**
     * @Type("string")
     */
    public $titel;

    /**
     * @Type("string")
     */
    public $link;

    /**
     * @Type("string")
     */
    public $omschrijving;

    /**
     * @Type("string")
     */
    public $language;

    /**
     * @Type("string")
     */
    public $copyright;

    /**
     * @Type("string")
     */
    public $gebruik;

    /**
     * @Exclude
     */
    public $image;

    /**
     * @Type("App\Infrastructure\Dto\Buienradar\WeerstationsDto")
     */
    public $actueel_weer;

    /**
     * @Exclude
     */
    public $verwachting_meerdaags;

    /**
     * @Exclude
     */
    public $verwachting_vandaag;
}
