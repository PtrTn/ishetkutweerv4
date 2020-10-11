<?php

declare(strict_types=1);

namespace App\Infrastructure\Deserializer;

use App\Application\Dto\RegionDto;
use App\Infrastructure\Dto\RegionResponseDto;

use function array_map;

final class RegionDtoDeserializer
{
    /**
     * @param RegionDto[] $regions
     *
     * @return RegionResponseDto[]
     */
    public function deserialize(array $regions): array
    {
        return array_map(static function (RegionDto $regionDto): RegionResponseDto {
            $dto = new RegionResponseDto();
            $dto->region = $regionDto->region;

            return $dto;
        }, $regions);
    }
}
