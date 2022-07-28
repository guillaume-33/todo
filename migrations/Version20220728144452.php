<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220728144452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF4BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_liste (id)');
        $this->addSql('CREATE INDEX IDX_FCF22AF4BCF5E72D ON liste (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF4BCF5E72D');
        $this->addSql('DROP INDEX IDX_FCF22AF4BCF5E72D ON liste');
        $this->addSql('ALTER TABLE liste DROP categorie_id');
    }
}
