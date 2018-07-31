<?php

namespace App\Infrastructure\ApiClient;

use App\Infrastructure\Dto\Buienradar\BuienradarnlDto;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;
use RuntimeException;

class BuienradarApiClient
{
    private const API_URL = 'http://xml.buienradar.nl/';

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(Client $httpClient, SerializerInterface $serializer)
    {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
    }

    public function getData()
    {
        $response = $this->httpClient->get(self::API_URL);
        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException('Unable to contact buienradar API');
        }
        $data = $response->getBody()->getContents();
        var_dump($data);
        $output = $this->serializer->deserialize($data, BuienradarnlDto::class, 'xml');
        var_dump($output);
        var_dump(simplexml_load_string($data));
    }
}
