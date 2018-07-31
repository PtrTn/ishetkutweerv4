<?php

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlKeyValuePairs;

class StationDto
{
    /**
     * @Type("array<string,string>")
     * @XmlKeyValuePairs
     */
    public $weerstation;
}
