<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use App\Tests\Acceptance\Fixtures\FixtureLoader;
use App\Tests\Acceptance\Fixtures\VenloCityEntityFixture;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ShowsCitiesTest extends WebTestCase
{
    protected KernelBrowser $client;
    private FixtureLoader $fixtureLoader;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->fixtureLoader = new FixtureLoader(self::$kernel);
        $this->fixtureLoader->createSchema();
    }

    public function tearDown(): void
    {
        $this->fixtureLoader->dropSchema();
    }

    public function testShouldListRegions(): void
    {
        $this->fixtureLoader->addAndLoadFixture(new VenloCityEntityFixture());

        $this->client->request('GET', '/api/cities');
        $response = $this->client->getResponse();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertStringContainsString('Venlo', $response->getContent());
    }
}
