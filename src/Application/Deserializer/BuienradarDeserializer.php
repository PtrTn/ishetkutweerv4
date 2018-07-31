<?php

namespace App\Application\Deserializer;

use App\Application\Factory\WeergegevensFactory;

class BuienradarDeserializer
{
    /**
     * @var WeergegevensFactory
     */
    private $factory;

    public function __construct(WeergegevensFactory $factory)
    {
        $this->factory = $factory;
    }

    public function parse(string $data)
    {
        $xml = simplexml_load_string($data);
        return $this->factory->create($xml->weergegevens);
        var_dump($xml);
    }
}
