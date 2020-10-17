<?php

declare(strict_types=1);

namespace App\Domain\Model;

final class Cities
{
    /** @var City[] */
    private array $cities;

    /** @param City[] $cities */
    public function __construct(array $cities)
    {
        $this->cities = $cities;
    }

    /** @return City[] */
    public function toArray(): array
    {
        return $this->cities;
    }
}
