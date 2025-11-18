<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251118173736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aliment ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE aliment ADD CONSTRAINT FK_70FF972BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_aliment (id)');
        $this->addSql('CREATE INDEX IDX_70FF972BBCF5E72D ON aliment (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aliment DROP FOREIGN KEY FK_70FF972BBCF5E72D');
        $this->addSql('DROP INDEX IDX_70FF972BBCF5E72D ON aliment');
        $this->addSql('ALTER TABLE aliment DROP categorie_id');
    }
}
