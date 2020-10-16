<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Application\Service\DateTimeImmutableFactory;
use App\Domain\Model\Forecast;
use App\Domain\Model\ForecastDay;
use App\Infrastructure\Dto\Buienradar\VerwachtingDag;
use App\Infrastructure\Dto\Buienradar\VerwachtingMeerdaags;

use function floor;

class ForecastFactory
{
    private DateTimeImmutableFactory $dateTimeImmutableFactory;

    public function __construct(DateTimeImmutableFactory $dateTimeImmutableFactory)
    {
        $this->dateTimeImmutableFactory = $dateTimeImmutableFactory;
    }

    public function create(VerwachtingMeerdaags $verwachtingMeerdaags): Forecast
    {
        return new Forecast(
            $this->createDay($verwachtingMeerdaags->dagPlus1),
            $this->createDay($verwachtingMeerdaags->dagPlus2),
            $this->createDay($verwachtingMeerdaags->dagPlus3),
            $this->createDay($verwachtingMeerdaags->dagPlus4),
            $this->createDay($verwachtingMeerdaags->dagPlus5)
        );
    }

    private function createDay(VerwachtingDag $dag): ForecastDay
    {
        $date = $this->dateTimeImmutableFactory->createForLocale($dag->datum, 'EEEE d MMM yyyy');
        $temperature = floor(((float) $dag->maxtemp + (float) $dag->maxtempmax) / 2);

        return new ForecastDay($date, $temperature);
    }
}
