<?php

declare(strict_types=1);

// phpcs:disable
namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190217164231 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE weather ADD summary VARCHAR(255) NOT NULL, ADD day1day VARCHAR(255) NOT NULL, ADD day1temp DOUBLE PRECISION NOT NULL, ADD day2day VARCHAR(255) NOT NULL, ADD day2temp DOUBLE PRECISION NOT NULL, ADD day3day VARCHAR(255) NOT NULL, ADD day3temp DOUBLE PRECISION NOT NULL, ADD day4day VARCHAR(255) NOT NULL, ADD day4temp DOUBLE PRECISION NOT NULL, ADD day5day VARCHAR(255) NOT NULL, ADD day5temp DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE import_job CHANGE status status ENUM(\'pending\', \'failed\', \'success\', \'skipped\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Weather DROP summary, DROP day1day, DROP day1temp, DROP day2day, DROP day2temp, DROP day3day, DROP day3temp, DROP day4day, DROP day4temp, DROP day5day, DROP day5temp');
    }
}
