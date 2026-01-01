<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260101183139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien ADD ville VARCHAR(150) DEFAULT NULL, ADD code_postal VARCHAR(10) DEFAULT NULL, ADD pays VARCHAR(100) DEFAULT NULL, ADD latitude DOUBLE PRECISION DEFAULT NULL, ADD longitude DOUBLE PRECISION DEFAULT NULL, ADD pieces INT DEFAULT NULL, ADD chambres INT DEFAULT NULL, ADD salles_de_bain INT DEFAULT NULL, ADD etage INT DEFAULT NULL, ADD annee_construction INT DEFAULT NULL, ADD chauffage VARCHAR(50) DEFAULT NULL, ADD ascenseur TINYINT(1) DEFAULT NULL, ADD parking TINYINT(1) DEFAULT NULL, ADD description_courte VARCHAR(255) DEFAULT NULL, ADD slug VARCHAR(180) DEFAULT NULL, ADD charges_mensuelles DOUBLE PRECISION DEFAULT NULL, ADD taxe_fonciere DOUBLE PRECISION DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD published_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_45EDC386989D9B62 ON bien (slug)');
        $this->addSql('ALTER TABLE client ADD type VARCHAR(30) DEFAULT NULL, ADD preferences JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', ADD is_verified TINYINT(1) DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455E7927C74 ON client (email)');
        $this->addSql('ALTER TABLE transaction ADD agent_id INT DEFAULT NULL, ADD statut VARCHAR(30) DEFAULT NULL, ADD mode VARCHAR(20) DEFAULT NULL, ADD commission_agence DOUBLE PRECISION DEFAULT NULL, ADD frais_notaire DOUBLE PRECISION DEFAULT NULL, ADD canal VARCHAR(30) DEFAULT NULL, ADD commentaire LONGTEXT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE date date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D13414710B FOREIGN KEY (agent_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_723705D13414710B ON transaction (agent_id)');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(100) DEFAULT NULL, ADD prenom VARCHAR(100) DEFAULT NULL, ADD telephone VARCHAR(30) DEFAULT NULL, ADD is_active TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_45EDC386989D9B62 ON bien');
        $this->addSql('ALTER TABLE bien DROP ville, DROP code_postal, DROP pays, DROP latitude, DROP longitude, DROP pieces, DROP chambres, DROP salles_de_bain, DROP etage, DROP annee_construction, DROP chauffage, DROP ascenseur, DROP parking, DROP description_courte, DROP slug, DROP charges_mensuelles, DROP taxe_fonciere, DROP created_at, DROP updated_at, DROP published_at');
        $this->addSql('DROP INDEX UNIQ_C7440455E7927C74 ON client');
        $this->addSql('ALTER TABLE client DROP type, DROP preferences, DROP is_verified, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D13414710B');
        $this->addSql('DROP INDEX IDX_723705D13414710B ON transaction');
        $this->addSql('ALTER TABLE transaction DROP agent_id, DROP statut, DROP mode, DROP commission_agence, DROP frais_notaire, DROP canal, DROP commentaire, DROP created_at, DROP updated_at, CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user DROP nom, DROP prenom, DROP telephone, DROP is_active');
    }
}
