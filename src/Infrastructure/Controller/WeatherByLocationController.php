<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\Query\WeatherByLocationQuery;
use App\Application\QueryHandler\WeatherQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class WeatherByLocationController extends AbstractController
{
    private WeatherQueryHandler $queryHandler;

    public function __construct(
        WeatherQueryHandler $queryHandler
    ) {
        $this->queryHandler = $queryHandler;
    }

    public function getWeatherByLocation(string $location): Response
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
