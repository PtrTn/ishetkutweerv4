<?php

declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201016221133 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE weather (id INT AUTO_INCREMENT NOT NULL, location VARCHAR(255) NOT NULL, lat DOUBLE PRECISION DEFAULT NULL, lon DOUBLE PRECISION DEFAULT NULL, date_time DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', temperature DOUBLE PRECISION DEFAULT NULL, rain DOUBLE PRECISION DEFAULT NULL, wind_speed DOUBLE PRECISION DEFAULT NULL, wind_direction INT DEFAULT NULL, temperature_rating INT NOT NULL, rain_rating INT NOT NULL, wind_rating INT NOT NULL, average_rating INT NOT NULL, description VARCHAR(255) NOT NULL, day1date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', day1temp DOUBLE PRECISION NOT NULL, day2date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', day2temp DOUBLE PRECISION NOT NULL, day3date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', day3temp DOUBLE PRECISION NOT NULL, day4date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', day4temp DOUBLE PRECISION NOT NULL, day5date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', day5temp DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE import_job (id INT AUTO_INCREMENT NOT NULL, created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status ENUM(\'pending\', \'failed\', \'success\', \'skipped\'), message LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE weather');
        $this->addSql('DROP TABLE import_job');
    }
}
