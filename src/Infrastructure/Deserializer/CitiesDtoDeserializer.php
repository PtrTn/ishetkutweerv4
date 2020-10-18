<?php

declare(strict_types=1);

namespace App\Infrastructure\Deserializer;

use App\Domain\Model\Cities;
use App\Domain\Model\City;
use App\Infrastructure\Dto\CityResponseDto;

use function array_map;

final class CitiesDtoDeserializer
{
    /** @return CityResponseDto[] */
    public function deserialize(Cities $cities): array
    {
        return array_map(static function (City $city): CityResponseDto {
            $dto = new CityResponseDto();
            $dto->region = $city->getName();

            return $dto;
        }, $cities->toArray());
    }
}
