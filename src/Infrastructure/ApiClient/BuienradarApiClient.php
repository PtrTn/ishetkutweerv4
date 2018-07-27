<?php

namespace App\Infrastructure\ApiClient;

use GuzzleHttp\Client;
use RuntimeException;

class BuienradarApiClient
{
    private const API_URL = 'http://xml.buienradar.nl/';

    /**
     * @var Client
     */
    private $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getData()
    {
        $response = $this->httpClient->get(self::API_URL);
        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException('Unable to contact buienradar API');
        }
        $data = $response->getBody()->getContents();
        $xml = simplexml_load_string($data);
        var_dump($xml);
    }
}
