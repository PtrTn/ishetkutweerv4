<?php

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;

class WeerstationsDto
{
    /**
     * @Type("array<App\Infrastructure\Dto\Buienradar\WeerstationDto>")
     * @XmlList(entry = "weerstation")
     */
    public $weerstations;
}
