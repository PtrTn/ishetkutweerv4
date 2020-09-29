<?php

declare(strict_types=1);

namespace App\Application\Assembler;

use App\Application\Factory\WeatherRatingDtoFactory;
use App\Domain\Dto\WeatherDto;

class WeatherRatingsDtoAssembler implements WeatherDtoAssemblerInterface
{
    private WeatherRatingDtoFactory $ratingsDtoFactory;

    public function __construct(WeatherRatingDtoFactory $ratingsDtoFactory)
    {
        $this->ratingsDtoFactory = $ratingsDtoFactory;
    }

    public function assemble(WeatherDto $dto): WeatherDto
    {
        $dto->rating = $this->ratingsDtoFactory->create($dto);

        return $dto;
    }
}
