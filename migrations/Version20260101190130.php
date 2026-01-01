<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260101190130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_45EDC386989D9B62 ON bien');
        $this->addSql('ALTER TABLE bien DROP description, DROP surface, DROP ville, DROP code_postal, DROP pays, DROP latitude, DROP longitude, DROP pieces, DROP chambres, DROP salles_de_bain, DROP etage, DROP annee_construction, DROP chauffage, DROP description_courte, DROP slug, DROP charges_mensuelles, DROP taxe_fonciere, CHANGE adresse localisation VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien ADD description LONGTEXT NOT NULL, ADD surface DOUBLE PRECISION NOT NULL, ADD ville VARCHAR(150) DEFAULT NULL, ADD code_postal VARCHAR(10) DEFAULT NULL, ADD pays VARCHAR(100) DEFAULT NULL, ADD latitude DOUBLE PRECISION DEFAULT NULL, ADD longitude DOUBLE PRECISION DEFAULT NULL, ADD pieces INT DEFAULT NULL, ADD chambres INT DEFAULT NULL, ADD salles_de_bain INT DEFAULT NULL, ADD etage INT DEFAULT NULL, ADD annee_construction INT DEFAULT NULL, ADD chauffage VARCHAR(50) DEFAULT NULL, ADD description_courte VARCHAR(255) DEFAULT NULL, ADD slug VARCHAR(180) DEFAULT NULL, ADD charges_mensuelles DOUBLE PRECISION DEFAULT NULL, ADD taxe_fonciere DOUBLE PRECISION DEFAULT NULL, CHANGE localisation adresse VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_45EDC386989D9B62 ON bien (slug)');
    }
}
