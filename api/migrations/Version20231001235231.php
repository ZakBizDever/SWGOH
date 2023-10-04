<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231001235231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE guilde (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, puissance_guilde INT NOT NULL, nb_joueurs INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero_vaisseau (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, vie INT NOT NULL, protection INT NOT NULL, vitesse INT NOT NULL, degat_critique INT DEFAULT NULL, puissance INT NOT NULL, tenacite INT NOT NULL, vol_vie INT DEFAULT NULL, degat_physique INT NOT NULL, cc_physique INT NOT NULL, degat_speciaux INT NOT NULL, cc_speciaux INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur (ally_code INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, niveau INT NOT NULL, pg_totale INT NOT NULL, pg_heros INT NOT NULL, pg_vaisseaux INT NOT NULL, lien_profil LONGTEXT NOT NULL, PRIMARY KEY(ally_code)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE guilde');
        $this->addSql('DROP TABLE hero_vaisseau');
        $this->addSql('DROP TABLE joueur');
    }
}
