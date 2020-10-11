<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\Query\WeatherByLocationQuery;
use App\Application\QueryHandler\WeatherQueryHandler;
use App\Infrastructure\Middleware\CacheMiddlewareInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class WeatherByLocationController extends AbstractController
{
    private WeatherQueryHandler $queryHandler;

    private Environment $templateEngine;

    private CacheMiddlewareInterface $cacheMiddleware;

    public function __construct(
        WeatherQueryHandler $queryHandler,
        Environment $templateEngine,
        CacheMiddlewareInterface $cacheMiddleware
    ) {
        $this->queryHandler = $queryHandler;
        $this->templateEngine = $templateEngine;
        $this->cacheMiddleware = $cacheMiddleware;
    }

    public function getWeatherByLocation(string $location): Response
    {
        $data = $this->queryHandler->getWeatherDataByLocationQuery(
            new WeatherByLocationQuery($location)
        );

        $template = $this->templateEngine->render('home.html.twig', [
            'data' => $data,
            'location' => $data->location,
            'forecast' => $data->forecast,
        ]);

        $response = new Response($template, Response::HTTP_OK);

        return $this->cacheMiddleware->apply($response, CacheMiddlewareInterface::FIVE_MINUTES);
    }
}
