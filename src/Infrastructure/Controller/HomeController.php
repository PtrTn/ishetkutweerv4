<?php

namespace App\Infrastructure\Controller;

use App\Application\Query\WeatherDataQuery;
use App\Application\QueryHandler\WeatherQueryHandler;
use App\Infrastructure\Locator\IpLocator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function index(Request $request)
    {
        return $this->render('test.html.twig');
        $ip = $request->getClientIp();
        $location = $this->ipLocator->getLocationForIp($ip);
        $data = $this->queryHandler->getWeatherDataByQuery(
            new WeatherDataQuery($location->lat, $location->lon)
        );
        var_dump($data);
    }
}
