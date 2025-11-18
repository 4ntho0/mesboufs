<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251118135229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE repa_categorie_repa (repa_id INT NOT NULL, categorie_repa_id INT NOT NULL, INDEX IDX_E1B95ABD5DEAEC1E (repa_id), INDEX IDX_E1B95ABD26942BC (categorie_repa_id), PRIMARY KEY(repa_id, categorie_repa_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE repa_categorie_repa ADD CONSTRAINT FK_E1B95ABD5DEAEC1E FOREIGN KEY (repa_id) REFERENCES repa (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE repa_categorie_repa ADD CONSTRAINT FK_E1B95ABD26942BC FOREIGN KEY (categorie_repa_id) REFERENCES categorie_repa (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE repa_categorie_repa DROP FOREIGN KEY FK_E1B95ABD5DEAEC1E');
        $this->addSql('ALTER TABLE repa_categorie_repa DROP FOREIGN KEY FK_E1B95ABD26942BC');
        $this->addSql('DROP TABLE repa_categorie_repa');
    }
}
