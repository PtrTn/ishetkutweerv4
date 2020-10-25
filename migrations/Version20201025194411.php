<?php

declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201025194411 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE weather CHANGE lat lat DOUBLE PRECISION NOT NULL, CHANGE lon lon DOUBLE PRECISION NOT NULL, CHANGE temperature temperature DOUBLE PRECISION NOT NULL, CHANGE rain rain DOUBLE PRECISION NOT NULL, CHANGE wind_speed wind_speed DOUBLE PRECISION NOT NULL, CHANGE wind_direction wind_direction INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE weather CHANGE lat lat DOUBLE PRECISION DEFAULT \'NULL\', CHANGE lon lon DOUBLE PRECISION DEFAULT \'NULL\', CHANGE temperature temperature DOUBLE PRECISION DEFAULT \'NULL\', CHANGE rain rain DOUBLE PRECISION DEFAULT \'NULL\', CHANGE wind_speed wind_speed DOUBLE PRECISION DEFAULT \'NULL\', CHANGE wind_direction wind_direction INT DEFAULT NULL');
    }
}
