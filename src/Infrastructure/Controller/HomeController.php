<?php

namespace App\Infrastructure\Controller;

use App\Application\Query\WeatherByLatLonQuery;
use App\Application\Query\WeatherByLocationQuery;
use App\Application\QueryHandler\WeatherQueryHandler;
use App\Infrastructure\Locator\IpLocator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Abstractcontroller
{
    /**
     * @var IpLocator
     */
    private $ipLocator;

    /**
     * @var WeatherQueryHandler
     */
    private $queryHandler;

    public function __construct(
        IpLocator $ipLocator,
        WeatherQueryHandler $queryHandler
    ) {
        $this->ipLocator = $ipLocator;
        $this->queryHandler = $queryHandler;
    }

    public function weatherByIp(Request $request)
    {
        $ip = $request->getClientIp();
        $location = $this->ipLocator->getLocationForIp($ip);
        $data = $this->queryHandler->getWeatherDataByLatLonQuery(
            new WeatherByLatLonQuery($location->lat, $location->lon)
        );

        return $this->render('home.html.twig', [
            'data' => $data,
            'location' => $data->location,
            'forecast' => $data->forecast,
        ]);
    }

    public function weatherByLocation(string $location)
    {
        $data = $this->queryHandler->getWeatherDataByLocationQuery(
            new WeatherByLocationQuery($location)
        );

        return $this->render('home.html.twig', [
            'data' => $data,
            'location' => $data->location,
            'forecast' => $data->forecast,
        ]);
    }
}
