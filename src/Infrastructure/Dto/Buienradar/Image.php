<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\Type;

class Image
{
    /** @Type("string") */
    public string $titel;

    /** @Type("string") */
    public string $link;

    /** @Type("string") */
    public string $url;

    /**
     * @var string|float
     * @Type("string")
     */
    public $width;

    /**
     * @var string|float
     * @Type("string")
     */
    public $height;
}
