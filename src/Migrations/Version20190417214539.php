<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190417214539 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, matricule INT NOT NULL, marque VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, carburant VARCHAR(255) NOT NULL, year INT NOT NULL, price DOUBLE PRECISION NOT NULL, caution DOUBLE PRECISION NOT NULL, boit_avitesse TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, car_id INT DEFAULT NULL, message VARCHAR(255) DEFAULT NULL, note INT DEFAULT NULL, INDEX IDX_67F068BCC3C6F69F (car_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etatdl (id INT AUTO_INCREMENT NOT NULL, aag VARCHAR(255) NOT NULL, aad VARCHAR(255) NOT NULL, aavd VARCHAR(255) NOT NULL, aavg VARCHAR(255) NOT NULL, ag VARCHAR(255) NOT NULL, ad VARCHAR(255) NOT NULL, av VARCHAR(255) NOT NULL, ar VARCHAR(255) NOT NULL, km BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, car_id INT NOT NULL, etatdl_id INT NOT NULL, datedebut DATE NOT NULL, datefin DATE NOT NULL, INDEX IDX_5E9E89CBA76ED395 (user_id), UNIQUE INDEX UNIQ_5E9E89CBC3C6F69F (car_id), UNIQUE INDEX UNIQ_5E9E89CBE1D7C2BD (etatdl_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messagerie (id INT AUTO_INCREMENT NOT NULL, message VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, datedenaissance DATE NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, codepostal INT NOT NULL, numtel VARCHAR(10) NOT NULL, numpermis VARCHAR(255) NOT NULL, anneepermis INT NOT NULL, INDEX IDX_8D93D649A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBC3C6F69F FOREIGN KEY (car_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBE1D7C2BD FOREIGN KEY (etatdl_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCC3C6F69F');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBC3C6F69F');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBE1D7C2BD');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBA76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A76ED395');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE etatdl');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE messagerie');
        $this->addSql('DROP TABLE user');
    }
}
