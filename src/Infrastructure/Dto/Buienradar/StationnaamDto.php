<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

class StationnaamDto
{
    /**
     * @Type("string")
     * @XmlAttribute
     */
    public string $regio;

    /**
     * @Type("string")
     * @XmlValue
     */
    public string $stationnaam;
}
