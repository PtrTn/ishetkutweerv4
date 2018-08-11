<?php

namespace App\Application\Assembler;

use App\Application\Factory\WeatherRatingsDtoFactory;
use App\Domain\Dto\WeatherDto;

class WeatherRatingsDtoAssembler implements WeatherDtoAssemblerInterface
{
    /**
     * @var WeatherRatingsDtoFactory
     */
    private $ratingsDtoFactory;

    public function __construct(WeatherRatingsDtoFactory $ratingsDtoFactory)
    {
        $this->ratingsDtoFactory = $ratingsDtoFactory;
    }

    public function assemble(WeatherDto $dto): WeatherDto
    {
        $dto->rating = $this->ratingsDtoFactory->create($dto);
        return $dto;
    }
}
