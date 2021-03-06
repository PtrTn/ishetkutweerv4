<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;

class VerwachtingVandaag
{
    /** @Type("string") */
    public string $titel;

    /** @Type("string") */
    public string $tijdweerbericht;

    /** @Type("string") */
    public string $samenvatting;

    /** @Type("string") */
    public string $tekst;

    /** @Type("string") */
    public string $formattedtekst;
}
