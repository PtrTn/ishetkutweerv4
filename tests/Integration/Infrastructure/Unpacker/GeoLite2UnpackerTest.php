<?php

namespace App\Tests\Integration\Infrastructure\Unpacker;

use App\Infrastructure\FileStorage\FileStorage;
use App\Infrastructure\Unpacker\GeoLite2Unpacker;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Filesystem\Filesystem;

class GeoLite2UnpackerTest extends KernelTestCase
{
    /**
     * @var string
     */
    private $temporaryFolder;

    /**
     * @var string
     */
    private $dataFolder;

    /**
     * @var GeoLite2Unpacker
     */
    private $unpacker;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    public function setUp()
    {
        self::bootKernel();
        $this->temporaryFolder = __DIR__ . '/tmp';
        $this->dataFolder = __DIR__ . '/data';
        $this->fileSystem = new Filesystem();
        $filestorage = new FileStorage($this->fileSystem, $this->temporaryFolder, $this->dataFolder);
        $this->unpacker = new GeoLite2Unpacker($filestorage);
    }

    /**
     * @test
     */
    public function shouldUnpackArchive()
    {
        $fixtureFile = __DIR__ . '/../../fixtures/GeoLite2-City_20181225.tar.gz';
        $expectedUnpackedFile = __DIR__ . '/unpacked-file.mmdb';

        $this->unpacker->unpack($fixtureFile, $expectedUnpackedFile);

        $this->assertTrue(
            $this->fileSystem->exists($expectedUnpackedFile),
            'Expected unpacked database file to be present'
        );
    }

    public function tearDown()
    {
        $this->fileSystem->remove($this->temporaryFolder);
        $this->fileSystem->remove($this->dataFolder);
        $this->fileSystem->remove(__DIR__ . '/unpacked-file.mmdb');
    }
}
