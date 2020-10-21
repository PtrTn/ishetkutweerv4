<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient;

use App\Infrastructure\Dto\Buienradar\BuienradarnlDto;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JMS\Serializer\Exception\RuntimeException;
use JMS\Serializer\SerializerInterface;

class BuienradarApiClient implements BuienradarApiClientInterface
{
    private const API_URL = 'http://xml.buienradar.nl/';

    private Client $httpClient;

    private SerializerInterface $serializer;

    public function __construct(Client $httpClient, SerializerInterface $serializer)
    {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
    }

    /** @throws SorryUnableToGetData */
    public function getData(): BuienradarnlDto
    {
        try {
            $response = $this->httpClient->get(self::API_URL);
        } catch (GuzzleException $exception) {
            throw SorryUnableToGetData::connectionException($exception);
        }

        if ($response->getStatusCode() !== 200) {
            throw SorryUnableToGetData::invalidStatusCode($response);
        }

        $data = $response->getBody()->getContents();
        try {
            $data = $this->serializer->deserialize($data, BuienradarnlDto::class, 'xml');
        } catch (RuntimeException $exception) {
            throw SorryUnableToGetData::deserializationError($exception);
        }

        if ($data instanceof BuienradarnlDto === false) {
            throw SorryUnableToGetData::unexpectedDeserializationResult($data);
        }

        return $data;
    }
}
