<?php declare(strict_types=1);

// phpcs:disable
namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180812202946 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE import_job CHANGE status status ENUM(\'pending\', \'failed\', \'success\')');
        $this->addSql('ALTER TABLE weather ADD station_name VARCHAR(255) NOT NULL, ADD lat DOUBLE PRECISION NOT NULL, ADD lon DOUBLE PRECISION NOT NULL, CHANGE location region VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE import_job CHANGE status status VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE Weather ADD location VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP region, DROP station_name, DROP lat, DROP lon');
    }
}
