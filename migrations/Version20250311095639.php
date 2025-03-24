<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250311095639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles ADD image VARCHAR(255) NOT NULL, ADD video VARCHAR(255) DEFAULT NULL, ADD podcast VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE cotisations ADD adherent_id INT DEFAULT NULL, CHANGE montant montant DOUBLE PRECISION NOT NULL, CHANGE statut statut TINYINT(1) NOT NULL, CHANGE date_paiement date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE cotisations ADD CONSTRAINT FK_C51B351C25F06C53 FOREIGN KEY (adherent_id) REFERENCES adherents (id)');
        $this->addSql('CREATE INDEX IDX_C51B351C25F06C53 ON cotisations (adherent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cotisations DROP FOREIGN KEY FK_C51B351C25F06C53');
        $this->addSql('DROP INDEX IDX_C51B351C25F06C53 ON cotisations');
        $this->addSql('ALTER TABLE cotisations DROP adherent_id, CHANGE montant montant VARCHAR(255) NOT NULL, CHANGE statut statut VARCHAR(255) NOT NULL, CHANGE date date_paiement DATETIME NOT NULL');
        $this->addSql('ALTER TABLE articles DROP image, DROP video, DROP podcast');
    }
}
