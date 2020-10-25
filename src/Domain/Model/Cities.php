<?php

declare(strict_types=1);

namespace App\Domain\Model;

use Iterator;

use function iterator_to_array;

/** @implements Iterator<int, City> */
final class Cities implements Iterator
{
    /** @var Iterator<City> */
    private Iterator $cities;

    /** @param Iterator<City> $cities */
    public function __construct(Iterator $cities)
    {
        $this->cities = $cities;
    }

    /** @return City[] */
    public function toArray(): array
    {
        return iterator_to_array($this->cities);
    }

    public function current(): City
    {
        return $this->cities->current();
    }

    public function next(): void
    {
        $this->cities->next();
    }

    /** @return string|float|int|bool|null */
    public function key()
    {
        return $this->cities->key();
    }

    public function valid(): bool
    {
        return $this->cities->valid();
    }

    public function rewind(): void
    {
        $this->cities->rewind();
    }
}
