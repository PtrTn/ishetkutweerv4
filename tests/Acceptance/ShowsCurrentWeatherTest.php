<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use App\Tests\Acceptance\Fixtures\FixtureLoader;
use App\Tests\Acceptance\Fixtures\WeatherEntityFixture;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ShowsCurrentWeatherTest extends WebTestCase
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

    public function testShouldShowWeatherRatingText(): void
    {
        $this->fixtureLoader->loadFixture(new WeatherEntityFixture());

        $this->client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('[data-test="rating-text"]', 'Het is kutweer');
    }
}
