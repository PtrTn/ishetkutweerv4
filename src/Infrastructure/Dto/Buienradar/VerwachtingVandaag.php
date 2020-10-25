<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;

class VerwachtingVandaag
{
    /**
     * @var mixed
     * @Type("string")
     */
    public $titel;

    /**
     * @var mixed
     * @Type("string")
     */
    public $tijdweerbericht;

    /**
     * @var mixed
     * @Type("string")
     */
    public $samenvatting;

    /**
     * @var mixed
     * @Type("string")
     */
    public $tekst;

    /**
     * @var mixed
     * @Type("string")
     */
    public $formattedtekst;
}
