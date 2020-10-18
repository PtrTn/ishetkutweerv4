<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Api;

use App\Application\QueryHandler\FetchCitiesQueryHandler;
use App\Infrastructure\Deserializer\CitiesDtoDeserializer;
use App\Infrastructure\Middleware\CacheMiddlewareInterface;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CitiesController extends AbstractController
{
    private FetchCitiesQueryHandler $queryHandler;

    private CitiesDtoDeserializer $deserializer;

    private CacheMiddlewareInterface $cacheMiddleware;

    public function __construct(
        FetchCitiesQueryHandler $queryHandler,
        CitiesDtoDeserializer $deserializer,
        CacheMiddlewareInterface $cacheMiddleware
    ) {
        $this->queryHandler = $queryHandler;
        $this->deserializer = $deserializer;
        $this->cacheMiddleware = $cacheMiddleware;
    }

    /**
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of cities",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(type="string")
     *     )
     * )
     */
    public function getCities(): Response
    {
        $cities = $this->queryHandler->handle();
        $responseDtos = $this->deserializer->deserialize($cities);

        $response = $this->json($responseDtos);

        return $this->cacheMiddleware->apply($response, CacheMiddlewareInterface::ONE_HOUR);
    }
}
