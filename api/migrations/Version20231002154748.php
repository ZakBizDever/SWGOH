<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002154748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hero_vaisseau CHANGE tenacite tenacite DOUBLE PRECISION NOT NULL, CHANGE cc_physique cc_physique DOUBLE PRECISION NOT NULL, CHANGE cc_speciaux cc_speciaux DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hero_vaisseau CHANGE tenacite tenacite INT NOT NULL, CHANGE cc_physique cc_physique INT NOT NULL, CHANGE cc_speciaux cc_speciaux INT NOT NULL');
    }
}
