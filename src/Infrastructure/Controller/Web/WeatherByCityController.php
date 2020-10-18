<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Web;

use App\Application\Query\WeatherByCityQuery;
use App\Application\QueryHandler\WeatherByCityQueryHandler;
use App\Infrastructure\Middleware\CacheMiddlewareInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class WeatherByCityController extends AbstractController
{
    private WeatherByCityQueryHandler $queryHandler;

    private Environment $templateEngine;

    private CacheMiddlewareInterface $cacheMiddleware;

    public function __construct(
        WeatherByCityQueryHandler $queryHandler,
        Environment $templateEngine,
        CacheMiddlewareInterface $cacheMiddleware
    ) {
        $this->queryHandler = $queryHandler;
        $this->templateEngine = $templateEngine;
        $this->cacheMiddleware = $cacheMiddleware;
    }

    public function getWeatherByCity(string $city): Response
    {
        $weatherReport = $this->queryHandler->handle(
            new WeatherByCityQuery($city)
        );

        $template = $this->templateEngine->render('home.html.twig', [
            'currentWeather' => $weatherReport->getCurrentWeather(),
            'description' => $weatherReport->getDescription()->toString(),
            'forecast' => $weatherReport->getForecast(),
            'rating' => $weatherReport->getRating(),
            'location' => $weatherReport->getLocation(),
            'dateTime' => $weatherReport->getDateTime()->toDateTimeImmutable(),
        ]);

        $response = new Response($template, Response::HTTP_OK);

        return $this->cacheMiddleware->apply($response, CacheMiddlewareInterface::FIVE_MINUTES);
    }
}
