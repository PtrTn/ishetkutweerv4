<?php

namespace App\Infrastructure\Controller;

use App\Infrastructure\ApiClient\BuienradarApiClient;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    /**
     * @var BuienradarApiClient
     */
    private $apiClient;

    public function __construct(BuienradarApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function index()
    {
        $this->apiClient->getData();
        return new Response('hoi');
    }
}
