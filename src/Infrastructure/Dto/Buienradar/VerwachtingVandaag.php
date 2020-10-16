<?php

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;

class VerwachtingVandaag
{
    /**
     * @var string
     * @Type("string")
     */
    public $titel;

    /**
     * @var string
     * @Type("string")
     */
    public $tijdweerbericht;

    /**
     * @var string
     * @Type("string")
     */
    public $samenvatting;

    /**
     * @var string
     * @Type("string")
     */
    public $tekst;

    /**
     * @var string
     * @Type("string")
     */
    public $formattedtekst;
}
