<?php

declare(strict_types=1);

namespace App\Domain\Model;

use DateTimeImmutable;

final class ReportDateTime
{
    private DateTimeImmutable $dateTimeImmutable;

    public function __construct(DateTimeImmutable $dateTimeImmutable)
    {
        $this->dateTimeImmutable = $dateTimeImmutable;
    }

    public function getDateTimeImmutable(): DateTimeImmutable
    {
        return $this->dateTimeImmutable;
    }
}
