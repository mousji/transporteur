<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220324193855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chauffeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, date_permis DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marchandise (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, quantite DOUBLE PRECISION DEFAULT NULL, origine VARCHAR(255) DEFAULT NULL, destination VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, chauffeur_id INT DEFAULT NULL, vehicule_id INT DEFAULT NULL, expediteur_id INT DEFAULT NULL, destinataire_id INT DEFAULT NULL, date DATETIME DEFAULT NULL, INDEX IDX_66AB212E85C0B3BE (chauffeur_id), INDEX IDX_66AB212E4A4A3511 (vehicule_id), INDEX IDX_66AB212E10335F61 (expediteur_id), INDEX IDX_66AB212EA4F84F6E (destinataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport_marchandise (transport_id INT NOT NULL, marchandise_id INT NOT NULL, INDEX IDX_4FC692D99909C13F (transport_id), INDEX IDX_4FC692D9F7FBEBE (marchandise_id), PRIMARY KEY(transport_id, marchandise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, marque VARCHAR(255) NOT NULL, modele VARCHAR(255) NOT NULL, kilometrage DOUBLE PRECISION NOT NULL, date_premiere_circulation DATE DEFAULT NULL, date_derniere_maintenance DATE DEFAULT NULL, capacite DOUBLE PRECISION NOT NULL, periodicite_maintenance INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, immatriculation VARCHAR(255) DEFAULT NULL, type_technique VARCHAR(255) DEFAULT NULL, etat VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E85C0B3BE FOREIGN KEY (chauffeur_id) REFERENCES chauffeur (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E10335F61 FOREIGN KEY (expediteur_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EA4F84F6E FOREIGN KEY (destinataire_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE transport_marchandise ADD CONSTRAINT FK_4FC692D99909C13F FOREIGN KEY (transport_id) REFERENCES transport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transport_marchandise ADD CONSTRAINT FK_4FC692D9F7FBEBE FOREIGN KEY (marchandise_id) REFERENCES marchandise (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E85C0B3BE');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E10335F61');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EA4F84F6E');
        $this->addSql('ALTER TABLE transport_marchandise DROP FOREIGN KEY FK_4FC692D9F7FBEBE');
        $this->addSql('ALTER TABLE transport_marchandise DROP FOREIGN KEY FK_4FC692D99909C13F');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E4A4A3511');
        $this->addSql('DROP TABLE chauffeur');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE marchandise');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP TABLE transport_marchandise');
        $this->addSql('DROP TABLE vehicule');
    }
}
