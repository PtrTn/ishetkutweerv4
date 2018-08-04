<?php

namespace App\Application\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;

class BuienradarnlDto
{
    /**
     * @var WeergegevensDto
     * @Type("App\Application\Dto\Buienradar\WeergegevensDto")
     */
    public $weergegevens;
}
