<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto;

use JsonSerializable;

final class RegionResponseDto implements JsonSerializable
{
    public string $region;

    public function jsonSerialize(): string
    {
        return $this->region;
    }
}
