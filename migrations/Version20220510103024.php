<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220510103024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acces_portail ADD habilitation_id INT NOT NULL');
        $this->addSql('ALTER TABLE acces_portail ADD CONSTRAINT FK_F3A66F9C389712CD FOREIGN KEY (habilitation_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_F3A66F9C389712CD ON acces_portail (habilitation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acces_portail DROP FOREIGN KEY FK_F3A66F9C389712CD');
        $this->addSql('DROP INDEX IDX_F3A66F9C389712CD ON acces_portail');
        $this->addSql('ALTER TABLE acces_portail DROP habilitation_id');
    }
}
