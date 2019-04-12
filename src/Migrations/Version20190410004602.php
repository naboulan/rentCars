<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190410004602 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, message VARCHAR(255) DEFAULT NULL, note INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etatdl (id INT AUTO_INCREMENT NOT NULL, aag VARCHAR(255) NOT NULL, aad VARCHAR(255) NOT NULL, aavd VARCHAR(255) NOT NULL, aavg VARCHAR(255) NOT NULL, ag VARCHAR(255) NOT NULL, ad VARCHAR(255) NOT NULL, av VARCHAR(255) NOT NULL, ar VARCHAR(255) NOT NULL, km BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, car_id INT NOT NULL, etatdl_id INT NOT NULL, datedebut DATE NOT NULL, datefin DATE NOT NULL, INDEX IDX_5E9E89CBA76ED395 (user_id), UNIQUE INDEX UNIQ_5E9E89CBC3C6F69F (car_id), UNIQUE INDEX UNIQ_5E9E89CBE1D7C2BD (etatdl_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messagerie (id INT AUTO_INCREMENT NOT NULL, message VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBC3C6F69F FOREIGN KEY (car_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBE1D7C2BD FOREIGN KEY (etatdl_id) REFERENCES location (id)');
        $this->addSql('DROP TABLE loueur');
        $this->addSql('DROP TABLE toto');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DA76ED395');
        $this->addSql('DROP INDEX IDX_773DE69DA76ED395 ON car');
        $this->addSql('ALTER TABLE car CHANGE user_id car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_773DE69DC3C6F69F ON car (car_id)');
        $this->addSql('ALTER TABLE user ADD user_id INT DEFAULT NULL, ADD email VARCHAR(255) NOT NULL, ADD mdp VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD datedenaissance DATE NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD ville VARCHAR(255) NOT NULL, ADD codepostal INT NOT NULL, ADD numtel VARCHAR(10) NOT NULL, ADD numpermis VARCHAR(255) NOT NULL, ADD anneepermis INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649A76ED395 ON user (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBC3C6F69F');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBE1D7C2BD');
        $this->addSql('CREATE TABLE loueur (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE toto (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE etatdl');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE messagerie');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DC3C6F69F');
        $this->addSql('DROP INDEX IDX_773DE69DC3C6F69F ON car');
        $this->addSql('ALTER TABLE car CHANGE car_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_773DE69DA76ED395 ON car (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A76ED395');
        $this->addSql('DROP INDEX IDX_8D93D649A76ED395 ON user');
        $this->addSql('ALTER TABLE user DROP user_id, DROP email, DROP mdp, DROP nom, DROP prenom, DROP datedenaissance, DROP adresse, DROP ville, DROP codepostal, DROP numtel, DROP numpermis, DROP anneepermis');
    }
}
