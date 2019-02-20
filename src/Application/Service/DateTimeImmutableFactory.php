<?php

namespace App\Application\Service;

use DateTimeImmutable;
use IntlDateFormatter;

class DateTimeImmutableFactory
{
    public function createForLocale(
        string $datetime,
        string $pattern,
        string $locale = 'nl_NL'
    ): DateTimeImmutable {
        $formatter = IntlDateFormatter::create(
            $locale,
            IntlDateFormatter::NONE,
            IntlDateFormatter::NONE,
            NULL,
            NULL,
            $pattern
        );
        $timestamp = $formatter->parse($datetime);

        $dateTimeImmutable = DateTimeImmutable::createFromFormat('U', $timestamp);
        if ($dateTimeImmutable instanceof DateTimeImmutable) {
            return $dateTimeImmutable;
        }

        throw new \InvalidArgumentException(sprintf(
            'Unable to format date "%s" for format "%s" in locale "%s"',
            $datetime,
            $pattern,
            $locale
        ));
    }
}
