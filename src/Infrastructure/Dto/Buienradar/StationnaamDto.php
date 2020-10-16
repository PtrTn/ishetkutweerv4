<?php

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

class StationnaamDto
{
    /**
     * @var string
     * @Type("string")
     * @XmlAttribute
     */
    public $regio;

    /**
     * @var string
     * @Type("string")
     * @XmlValue
     */
    public $stationnaam;
}
