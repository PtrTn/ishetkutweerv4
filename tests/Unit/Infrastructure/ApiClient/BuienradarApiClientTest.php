<?php

namespace App\Tests\Unit\Infrastructure\ApiClient;

use App\Application\Dto\Buienradar\BuienradarnlDto;
use App\Infrastructure\ApiClient\BuienradarApiClient;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class BuienradarApiClientTest extends MockeryTestCase
{
    /**
     * @test
     */
    public function shouldGetData()
    {
        $response = Mockery::mock(ResponseInterface::class, [
            'getStatusCode' => 200,
            'getBody->getContents' => 'some-xml-string'
        ]);

        $httpClient = Mockery::mock(Client::class, ['get' => $response]);

        $serializer = Mockery::mock(SerializerInterface::class);
        $serializer->shouldReceive('deserialize')
            ->once()
            ->with('some-xml-string', BuienradarnlDto::class, 'xml')
            ->andReturn(new BuienradarnlDto());

        $client = new BuienradarApiClient($httpClient, $serializer);

        $data = $client->getData();

        $this->assertInstanceOf(BuienradarnlDto::class, $data);
    }

    /**
     * @test
     */
    public function shouldErrorOnNonSuccessStatusCode()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unable to contact buienradar API');

        $response = Mockery::mock(ResponseInterface::class, [
            'getStatusCode' => 400
        ]);

        $httpClient = Mockery::mock(Client::class, ['get' => $response]);
        $serializer = Mockery::mock(SerializerInterface::class);

        $client = new BuienradarApiClient($httpClient, $serializer);

        $client->getData();
    }

}
