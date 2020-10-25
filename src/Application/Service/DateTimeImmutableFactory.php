<?php

declare(strict_types=1);

namespace App\Application\Service;

use DateTimeImmutable;
use IntlDateFormatter;
use InvalidArgumentException;
use RuntimeException;

use function sprintf;

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
            null,
            IntlDateFormatter::GREGORIAN,
            $pattern
        );
        if ($formatter === false) {
            throw new RuntimeException('Unable to create datetime formatter');
        }

        $timestamp = $formatter->parse($datetime);

        $dateTimeImmutable = DateTimeImmutable::createFromFormat('U', (string) $timestamp);
        if ($dateTimeImmutable instanceof DateTimeImmutable) {
            return $dateTimeImmutable;
        }

        throw new InvalidArgumentException(sprintf(
            'Unable to format date "%s" for format "%s" in locale "%s"',
            $datetime,
            $pattern,
            $locale
        ));
    }
}
