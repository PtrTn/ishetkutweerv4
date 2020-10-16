<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\Exception\SorryWeatherNotFound;
use App\Application\Query\WeatherByLatLonQuery;
use App\Application\QueryHandler\WeatherByLatLonQueryHandler;
use App\Infrastructure\Locator\IpLocator;
use App\Infrastructure\Middleware\CacheMiddlewareInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class WeatherByIpController extends AbstractController
{
    private IpLocator $ipLocator;

    private WeatherByLatLonQueryHandler $queryHandler;

    private Environment $templateEngine;

    private CacheMiddlewareInterface $cacheMiddleware;

    public function __construct(
        IpLocator $ipLocator,
        WeatherByLatLonQueryHandler $queryHandler,
        Environment $templateEngine,
        CacheMiddlewareInterface $cacheMiddleware
    ) {
        $this->ipLocator = $ipLocator;
        $this->queryHandler = $queryHandler;
        $this->templateEngine = $templateEngine;
        $this->cacheMiddleware = $cacheMiddleware;
    }

    public function getWeatherByIp(Request $request): Response
    {
        $ipAddress = $request->getClientIp();
        $location = $this->ipLocator->getLocationForIp($ipAddress);
        try {
            $weatherReport = $this->queryHandler->handle(
                new WeatherByLatLonQuery($location->lat, $location->lon)
            );
        } catch (SorryWeatherNotFound $exception) {
            return $this->render('bundles/TwigBundle/Exception/error.html.twig');
        }

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
