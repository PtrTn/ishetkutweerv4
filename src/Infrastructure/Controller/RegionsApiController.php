<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\QueryHandler\FetchRegionsQueryHandler;
use App\Infrastructure\Deserializer\RegionDtoDeserializer;
use App\Infrastructure\Middleware\CacheMiddlewareInterface;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RegionsApiController extends AbstractController
{
    private FetchRegionsQueryHandler $queryHandler;

    private RegionDtoDeserializer $deserializer;

    private CacheMiddlewareInterface $cacheMiddleware;

    public function __construct(
        FetchRegionsQueryHandler $queryHandler,
        RegionDtoDeserializer $deserializer,
        CacheMiddlewareInterface $cacheMiddleware
    ) {
        $this->queryHandler = $queryHandler;
        $this->deserializer = $deserializer;
        $this->cacheMiddleware = $cacheMiddleware;
    }

    /**
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of regions",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(type="string")
     *     )
     * )
     */
    public function getRegions(): Response
    {
        $regions = $this->queryHandler->handle();
        $responseDtos = $this->deserializer->deserialize($regions);

        $response = $this->json($responseDtos);

        return $this->cacheMiddleware->apply($response, CacheMiddlewareInterface::ONE_HOUR);
    }
}
