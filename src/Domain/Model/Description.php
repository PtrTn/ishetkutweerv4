<?php

declare(strict_types=1);

namespace App\Domain\Model;

final class Description
{
    private string $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }

    public function toString(): string
    {
        return $this->description;
    }
}
