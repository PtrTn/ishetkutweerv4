<?php

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;

class WeerstationsDto
{
    /**
     * @Type("App\Infrastructure\Dto\Buienradar\StationDto")
     */
    public $weerstations;
}
