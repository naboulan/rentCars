<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190623170220 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBC3C6F69F');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A76ED395');
        $this->addSql('DROP INDEX IDX_8D93D649A76ED395 ON user');
        $this->addSql('ALTER TABLE user ADD is_active TINYINT(1) NOT NULL, DROP user_id, CHANGE datedenaissance datedenaissance DATETIME NOT NULL, CHANGE anneepermis anneepermis DATE NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBC3C6F69F');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBC3C6F69F FOREIGN KEY (car_id) REFERENCES location (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user ADD user_id INT DEFAULT NULL, DROP is_active, CHANGE datedenaissance datedenaissance DATE NOT NULL, CHANGE anneepermis anneepermis INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D93D649A76ED395 ON user (user_id)');
    }
}
