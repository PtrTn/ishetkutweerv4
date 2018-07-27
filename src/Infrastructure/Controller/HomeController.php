<?php

namespace App\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController
{
    public function index()
    {
        return new JsonResponse(['hoi']);
    }
}
