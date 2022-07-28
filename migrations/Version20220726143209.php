<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220726143209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste ADD destinataire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF4A4F84F6E FOREIGN KEY (destinataire_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FCF22AF4A4F84F6E ON liste (destinataire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF4A4F84F6E');
        $this->addSql('DROP INDEX IDX_FCF22AF4A4F84F6E ON liste');
        $this->addSql('ALTER TABLE liste DROP destinataire_id');
    }
}
