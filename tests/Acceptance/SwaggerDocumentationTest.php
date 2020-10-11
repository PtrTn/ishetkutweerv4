<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SwaggerDocumentationTest extends WebTestCase
{
    protected KernelBrowser $client;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testShouldExposeSwaggerDocumentation(): void
    {
        $this->client->request('GET', '/api/doc');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('#swagger-ui');
    }
}
