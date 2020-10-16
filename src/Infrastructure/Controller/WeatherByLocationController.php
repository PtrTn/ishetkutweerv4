<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\Query\WeatherByLocationQuery;
use App\Application\QueryHandler\WeatherByLocationQueryHandler;
use App\Infrastructure\Middleware\CacheMiddlewareInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class WeatherByLocationController extends AbstractController
{
    private WeatherByLocationQueryHandler $queryHandler;

    private Environment $templateEngine;

    private CacheMiddlewareInterface $cacheMiddleware;

    public function __construct(
        WeatherByLocationQueryHandler $queryHandler,
        Environment $templateEngine,
        CacheMiddlewareInterface $cacheMiddleware
    ) {
        $this->queryHandler = $queryHandler;
        $this->templateEngine = $templateEngine;
        $this->cacheMiddleware = $cacheMiddleware;
    }

    public function getWeatherByLocation(string $location): Response
    {
        $weatherReport = $this->queryHandler->handle(
            new WeatherByLocationQuery($location)
        );

        $template = $this->templateEngine->render('home.html.twig', [
            'currentWeather' => $weatherReport->getCurrentWeather(),
            'description' => $weatherReport->getDescription()->getDescription(),
            'forecast' => $weatherReport->getForecast(),
            'rating' => $weatherReport->getRating(),
            'location' => $weatherReport->getLocation(),
            'dateTime' => $weatherReport->getDateTime()->getDateTimeImmutable(),
        ]);

        $response = new Response($template, Response::HTTP_OK);

        return $this->cacheMiddleware->apply($response, CacheMiddlewareInterface::FIVE_MINUTES);
    }
}
