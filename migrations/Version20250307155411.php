<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250307155411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cotisations (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, montant VARCHAR(255) NOT NULL, date_paiement DATETIME NOT NULL, statut VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cotisation_user DROP FOREIGN KEY FK_F3F526B53EAA84B1');
        $this->addSql('ALTER TABLE cotisation_user DROP FOREIGN KEY FK_F3F526B5A76ED395');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168A21214B7');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168A76ED395');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168BCF5E72D');
        $this->addSql('DROP TABLE cotisation_user');
        $this->addSql('DROP TABLE cotisation');
        $this->addSql('DROP TABLE articles');
        $this->addSql('ALTER TABLE user ADD cotisations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495B2994BB FOREIGN KEY (cotisations_id) REFERENCES cotisations (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6495B2994BB ON user (cotisations_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495B2994BB');
        $this->addSql('CREATE TABLE cotisation_user (cotisation_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_F3F526B5A76ED395 (user_id), INDEX IDX_F3F526B53EAA84B1 (cotisation_id), PRIMARY KEY(cotisation_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cotisation (id INT AUTO_INCREMENT NOT NULL, montant INT NOT NULL, date_paiement DATETIME NOT NULL, statut VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, categories_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, contenu LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_publication DATETIME NOT NULL, INDEX IDX_BFDD3168BCF5E72D (categorie_id), INDEX IDX_BFDD3168A21214B7 (categories_id), INDEX IDX_BFDD3168A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cotisation_user ADD CONSTRAINT FK_F3F526B53EAA84B1 FOREIGN KEY (cotisation_id) REFERENCES cotisation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cotisation_user ADD CONSTRAINT FK_F3F526B5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE cotisations');
        $this->addSql('DROP INDEX IDX_8D93D6495B2994BB ON user');
        $this->addSql('ALTER TABLE user DROP cotisations_id');
    }
}
