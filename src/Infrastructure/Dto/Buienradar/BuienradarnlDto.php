<?php

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;

class BuienradarnlDto
{
    /**
     * @var WeergegevensDto
     * @Type("App\Infrastructure\Dto\Buienradar\WeergegevensDto")
     */
    public $weergegevens;
}
