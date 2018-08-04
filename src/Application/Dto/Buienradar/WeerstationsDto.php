<?php

namespace App\Application\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;

class WeerstationsDto
{
    /**
     * @var WeerstationDto[]
     * @Type("array<App\Application\Dto\Buienradar\WeerstationDto>")
     * @XmlList(entry = "weerstation")
     */
    public $weerstations;
}
