<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190415235756 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DC3C6F69F');
        $this->addSql('DROP INDEX IDX_773DE69DC3C6F69F ON car');
        $this->addSql('ALTER TABLE car ADD location_id INT NOT NULL, CHANGE car_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D64D218E FOREIGN KEY (location_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_773DE69D64D218E ON car (location_id)');
        $this->addSql('CREATE INDEX IDX_773DE69DA76ED395 ON car (user_id)');
        $this->addSql('ALTER TABLE commentaire ADD car_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_67F068BCC3C6F69F ON commentaire (car_id)');
        $this->addSql('CREATE INDEX IDX_67F068BCA76ED395 ON commentaire (user_id)');
        $this->addSql('ALTER TABLE etatdl ADD location_id INT NOT NULL');
        $this->addSql('ALTER TABLE etatdl ADD CONSTRAINT FK_705EAA7F64D218E FOREIGN KEY (location_id) REFERENCES etatdl (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_705EAA7F64D218E ON etatdl (location_id)');
        $this->addSql('ALTER TABLE messagerie ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE messagerie ADD CONSTRAINT FK_14E8F60CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_14E8F60CA76ED395 ON messagerie (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D64D218E');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DA76ED395');
        $this->addSql('DROP INDEX UNIQ_773DE69D64D218E ON car');
        $this->addSql('DROP INDEX IDX_773DE69DA76ED395 ON car');
        $this->addSql('ALTER TABLE car DROP location_id, CHANGE user_id car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_773DE69DC3C6F69F ON car (car_id)');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCC3C6F69F');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('DROP INDEX IDX_67F068BCC3C6F69F ON commentaire');
        $this->addSql('DROP INDEX IDX_67F068BCA76ED395 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP car_id, DROP user_id');
        $this->addSql('ALTER TABLE etatdl DROP FOREIGN KEY FK_705EAA7F64D218E');
        $this->addSql('DROP INDEX UNIQ_705EAA7F64D218E ON etatdl');
        $this->addSql('ALTER TABLE etatdl DROP location_id');
        $this->addSql('ALTER TABLE messagerie DROP FOREIGN KEY FK_14E8F60CA76ED395');
        $this->addSql('DROP INDEX IDX_14E8F60CA76ED395 ON messagerie');
        $this->addSql('ALTER TABLE messagerie DROP user_id');
    }
}
