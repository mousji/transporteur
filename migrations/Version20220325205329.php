<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220325205329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise_utilisatrice (id INT AUTO_INCREMENT NOT NULL, raison_sociale VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, cp VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chauffeur ADD entreprise_utilisatrice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chauffeur ADD CONSTRAINT FK_5CA777B81BF0212C FOREIGN KEY (entreprise_utilisatrice_id) REFERENCES entreprise_utilisatrice (id)');
        $this->addSql('CREATE INDEX IDX_5CA777B81BF0212C ON chauffeur (entreprise_utilisatrice_id)');
        $this->addSql('ALTER TABLE utilisateur ADD entreprise_utilisatrice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B31BF0212C FOREIGN KEY (entreprise_utilisatrice_id) REFERENCES entreprise_utilisatrice (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B31BF0212C ON utilisateur (entreprise_utilisatrice_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chauffeur DROP FOREIGN KEY FK_5CA777B81BF0212C');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B31BF0212C');
        $this->addSql('DROP TABLE entreprise_utilisatrice');
        $this->addSql('DROP INDEX IDX_5CA777B81BF0212C ON chauffeur');
        $this->addSql('ALTER TABLE chauffeur DROP entreprise_utilisatrice_id');
        $this->addSql('DROP INDEX IDX_1D1C63B31BF0212C ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP entreprise_utilisatrice_id');
    }
}
