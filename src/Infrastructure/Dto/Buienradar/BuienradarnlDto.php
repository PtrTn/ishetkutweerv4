<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;

class BuienradarnlDto
{
    /** @Type("App\Infrastructure\Dto\Buienradar\WeergegevensDto") */
    public WeergegevensDto $weergegevens;
}
