<?php

declare(strict_types=1);

namespace App\Application\QueryHandler;

use App\Application\Repository\CityRepositoryInterface;
use App\Domain\Model\Cities;

class FetchCitiesQueryHandler
{
    private CityRepositoryInterface $repository;

    public function __construct(CityRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(): Cities
    {
        return $this->repository->getAllCities();
    }
}
