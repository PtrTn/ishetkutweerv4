<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Infrastructure\Feed\FeedItem;
use DateTime;
use Eko\FeedBundle\Feed\FeedManager;
use Symfony\Component\HttpFoundation\Response;

class FeedController
{
    private FeedManager $feedManager;

    public function __construct(FeedManager $feedManager)
    {
        $this->feedManager = $feedManager;
    }

    public function rssFeed(): Response
    {
        // Todo, replace hardcoded data.
        $feed = $this->feedManager->get('weather');
        $feed->add(new FeedItem(
            'Vandaag is het kutweer',
            'Het lijkt de komende dagen wel lente in Nederland. ' .
            'Storingen blijven uit de buurt en de zon heeft ruim baan. ' .
            'Met een zuidenwind komt in Limburg de 16 graden misschien zelfs op de thermometer.',
            'http://www.ishetkutweer.nl',
            new DateTime('now')
        ));

        return new Response($feed->render('rss'));
    }

    public function atomFeed(): Response
    {
        // Todo, replace hardcoded data.
        $feed = $this->feedManager->get('weather');
        $feed->add(new FeedItem(
            'Vandaag is het kutweer',
            'Het lijkt de komende dagen wel lente in Nederland. ' .
            'Storingen blijven uit de buurt en de zon heeft ruim baan. ' .
            'Met een zuidenwind komt in Limburg de 16 graden misschien zelfs op de thermometer.',
            'http://www.ishetkutweer.nl',
            new DateTime('now')
        ));

        return new Response($feed->render('atom'));
    }
}
