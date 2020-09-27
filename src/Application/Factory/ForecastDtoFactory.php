<?php

namespace App\Application\Factory;

use App\Application\Dto\Buienradar\VerwachtingDag;
use App\Application\Dto\Buienradar\VerwachtingMeerdaags;
use App\Application\Service\DateTimeImmutableFactory;
use App\Domain\Dto\ForecastDayDto;
use App\Domain\Dto\ForecastDto;

class ForecastDtoFactory
{

    /**
     * @var \App\Application\Service\DateTimeImmutableFactory
     */
    private $dateTimeImmutableFactory;

    public function __construct(DateTimeImmutableFactory $dateTimeImmutableFactory)
    {
        $this->dateTimeImmutableFactory = $dateTimeImmutableFactory;
    }

    public function create(VerwachtingMeerdaags $verwachtingMeerdaags): ForecastDto
    {
        $dto = new ForecastDto();
        $dto->day1 = $this->createDay($verwachtingMeerdaags->dagPlus1);
        $dto->day2 = $this->createDay($verwachtingMeerdaags->dagPlus2);
        $dto->day3 = $this->createDay($verwachtingMeerdaags->dagPlus3);
        $dto->day4 = $this->createDay($verwachtingMeerdaags->dagPlus4);
        $dto->day5 = $this->createDay($verwachtingMeerdaags->dagPlus5);

        return $dto;
    }

    private function createDay(VerwachtingDag $dag): ForecastDayDto
    {
        $dto = new ForecastDayDto;
        $dto->temperature = floor(((float) $dag->maxtemp + (float) $dag->maxtempmax) / 2);
        $dto->date = $this->dateTimeImmutableFactory->createForLocale($dag->datum, 'EEEE d MMM yyyy');

        return $dto;
    }
}
