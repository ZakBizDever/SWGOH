<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002143532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hero_vaisseau ADD player_code INT NOT NULL');
        $this->addSql('ALTER TABLE joueur ADD guild INT NOT NULL, CHANGE ally_code ally_code INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hero_vaisseau DROP player_code');
        $this->addSql('ALTER TABLE joueur DROP guild, CHANGE ally_code ally_code INT AUTO_INCREMENT NOT NULL');
    }
}
