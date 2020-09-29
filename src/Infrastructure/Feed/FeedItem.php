<?php

declare(strict_types=1);

namespace App\Infrastructure\Feed;

use DateTime;
use Eko\FeedBundle\Item\Writer\ItemInterface;

class FeedItem implements ItemInterface
{
    private string $title;

    private string $description;

    private string $link;

    private DateTime $publicationDate;

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

    public function getFeedItemTitle(): string
    {
        return $this->title;
    }

    public function getFeedItemDescription(): string
    {
        return $this->description;
    }

    public function getFeedItemLink(): string
    {
        return $this->link;
    }

    public function getFeedItemPubDate(): DateTime
    {
        return $this->publicationDate;
    }
}
