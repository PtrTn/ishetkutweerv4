<?php

namespace App\Infrastructure\Feed;

use DateTime;
use Eko\FeedBundle\Item\Writer\ItemInterface;

class FeedItem implements ItemInterface
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $link;

    /**
     * @var DateTime
     */
    private $publicationDate;

    public function __construct(
        string $title,
        string $description,
        string $link,
        DateTime $publicationDate
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->link = $link;
        $this->publicationDate = $publicationDate;
    }

    public function getFeedItemTitle()
    {
        return $this->title;
    }

    public function getFeedItemDescription()
    {
        return $this->description;
    }

    public function getFeedItemLink()
    {
        return $this->link;
    }

    public function getFeedItemPubDate()
    {
        return $this->publicationDate;
    }
}
