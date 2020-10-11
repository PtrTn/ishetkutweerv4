<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\Exception\SorryWeatherNotFound;
use App\Application\Query\WeatherByLatLonQuery;
use App\Application\QueryHandler\WeatherQueryHandler;
use App\Infrastructure\Locator\IpLocator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WeatherByIpController extends AbstractController
{
    private IpLocator $ipLocator;

    private WeatherQueryHandler $queryHandler;

    public function __construct(
        IpLocator $ipLocator,
        WeatherQueryHandler $queryHandler
    ) {
        $this->ipLocator = $ipLocator;
        $this->queryHandler = $queryHandler;
    }

    public function getWeatherByIp(Request $request): Response
    {
        $ipAddress = $request->getClientIp();
        $location = $this->ipLocator->getLocationForIp($ipAddress);
        try {
            $data = $this->queryHandler->getWeatherDataByLatLonQuery(
                new WeatherByLatLonQuery($location->lat, $location->lon)
            );
        } catch (SorryWeatherNotFound $exception) {
            return $this->render('bundles/TwigBundle/Exception/error.html.twig');
        }

        return $this->render('home.html.twig', [
            'data' => $data,
            'location' => $data->location,
            'forecast' => $data->forecast,
        ]);
    }
}
