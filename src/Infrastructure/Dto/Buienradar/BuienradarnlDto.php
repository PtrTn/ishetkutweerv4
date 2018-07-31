<?php

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;

class BuienradarnlDto
{
    /**
     * @Type("App\Infrastructure\Dto\Buienradar\WeergegevensDto")
     */
    public $weergegevens;
}
