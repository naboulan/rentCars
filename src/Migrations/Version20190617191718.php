<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190617191718 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D64D218E');
        $this->addSql('DROP INDEX UNIQ_773DE69D64D218E ON car');
        $this->addSql('ALTER TABLE car DROP location_id');
        $this->addSql('ALTER TABLE location DROP INDEX UNIQ_5E9E89CBC3C6F69F, ADD INDEX IDX_5E9E89CBC3C6F69F (car_id)');
        $this->addSql('ALTER TABLE location CHANGE car_id car_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE car ADD location_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D64D218E FOREIGN KEY (location_id) REFERENCES car (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_773DE69D64D218E ON car (location_id)');
        $this->addSql('ALTER TABLE location DROP INDEX IDX_5E9E89CBC3C6F69F, ADD UNIQUE INDEX UNIQ_5E9E89CBC3C6F69F (car_id)');
        $this->addSql('ALTER TABLE location CHANGE car_id car_id INT NOT NULL');
    }
}
