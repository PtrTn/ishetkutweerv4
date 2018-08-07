<?php

namespace App\Infrastructure\Controller;

use App\Application\Query\WeatherDataQuery;
use App\Application\QueryHandler\WeatherQueryHandler;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    /**
     * @var WeatherQueryHandler
     */
    private $queryHandler;

    public function __construct(WeatherQueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
    }

    public function index()
    {
        $lat = 51.498401;
        $lon = 3.602145;
        $data = $this->queryHandler->getWeatherData(
            new WeatherDataQuery($lat, $lon)
        );
        var_dump($data);
        return new Response('hoi');
    }
}
