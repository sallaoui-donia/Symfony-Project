<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201224132711 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE camping (id INT AUTO_INCREMENT NOT NULL, gerant_id INT DEFAULT NULL, nom_c VARCHAR(50) NOT NULL, program VARCHAR(255) NOT NULL, date_fin DATE NOT NULL, date_debut DATE NOT NULL, destination VARCHAR(50) NOT NULL, nbrplaces INT NOT NULL, nbrbus INT NOT NULL, prix_c VARCHAR(255) NOT NULL, INDEX IDX_81A904E4A500A924 (gerant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, club_id INT DEFAULT NULL, nom_c VARCHAR(50) NOT NULL, activite_c VARCHAR(50) NOT NULL, adresse_c VARCHAR(50) NOT NULL, prix_c VARCHAR(50) NOT NULL, INDEX IDX_B8EE387261190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, gerant_id INT DEFAULT NULL, nom_e VARCHAR(255) NOT NULL, date_e DATE NOT NULL, type_e VARCHAR(50) NOT NULL, adresse_e VARCHAR(50) NOT NULL, prix_e VARCHAR(50) NOT NULL, INDEX IDX_3BAE0AA7A500A924 (gerant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, gerant_id INT DEFAULT NULL, nom_f VARCHAR(50) NOT NULL, niveau VARCHAR(50) NOT NULL, objectif VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, prix_f VARCHAR(50) NOT NULL, INDEX IDX_404021BFA500A924 (gerant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gerant (id INT AUTO_INCREMENT NOT NULL, nom_g VARCHAR(50) NOT NULL, email_g VARCHAR(50) NOT NULL, telephone INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, gerant_id INT DEFAULT NULL, nom_enfant VARCHAR(50) NOT NULL, prenom_enfant VARCHAR(255) NOT NULL, nom_parent VARCHAR(50) NOT NULL, telephone_parent INT NOT NULL, date_naissance DATE NOT NULL, INDEX IDX_5E90F6D6A500A924 (gerant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_user (inscription_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_AC25ADFA5DAC5993 (inscription_id), INDEX IDX_AC25ADFAA76ED395 (user_id), PRIMARY KEY(inscription_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_club (inscription_id INT NOT NULL, club_id INT NOT NULL, INDEX IDX_995843C15DAC5993 (inscription_id), INDEX IDX_995843C161190A32 (club_id), PRIMARY KEY(inscription_id, club_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_event (inscription_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_69E75EEA5DAC5993 (inscription_id), INDEX IDX_69E75EEA71F7E88B (event_id), PRIMARY KEY(inscription_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_randonne (inscription_id INT NOT NULL, randonne_id INT NOT NULL, INDEX IDX_B6E51C565DAC5993 (inscription_id), INDEX IDX_B6E51C56CF1641FE (randonne_id), PRIMARY KEY(inscription_id, randonne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_formation (inscription_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_E655E3A75DAC5993 (inscription_id), INDEX IDX_E655E3A75200282E (formation_id), PRIMARY KEY(inscription_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_camping (inscription_id INT NOT NULL, camping_id INT NOT NULL, INDEX IDX_A878F2085DAC5993 (inscription_id), INDEX IDX_A878F2083CC6385 (camping_id), PRIMARY KEY(inscription_id, camping_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE randonne (id INT AUTO_INCREMENT NOT NULL, gerant_id INT DEFAULT NULL, nom_r VARCHAR(50) NOT NULL, program VARCHAR(255) NOT NULL, date_r DATE NOT NULL, prix_r VARCHAR(50) NOT NULL, destination VARCHAR(50) NOT NULL, INDEX IDX_1F7063F3A500A924 (gerant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE camping ADD CONSTRAINT FK_81A904E4A500A924 FOREIGN KEY (gerant_id) REFERENCES gerant (id)');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE387261190A32 FOREIGN KEY (club_id) REFERENCES gerant (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7A500A924 FOREIGN KEY (gerant_id) REFERENCES gerant (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFA500A924 FOREIGN KEY (gerant_id) REFERENCES gerant (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A500A924 FOREIGN KEY (gerant_id) REFERENCES gerant (id)');
        $this->addSql('ALTER TABLE inscription_user ADD CONSTRAINT FK_AC25ADFA5DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_user ADD CONSTRAINT FK_AC25ADFAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_club ADD CONSTRAINT FK_995843C15DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_club ADD CONSTRAINT FK_995843C161190A32 FOREIGN KEY (club_id) REFERENCES club (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_event ADD CONSTRAINT FK_69E75EEA5DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_event ADD CONSTRAINT FK_69E75EEA71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_randonne ADD CONSTRAINT FK_B6E51C565DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_randonne ADD CONSTRAINT FK_B6E51C56CF1641FE FOREIGN KEY (randonne_id) REFERENCES randonne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_formation ADD CONSTRAINT FK_E655E3A75DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_formation ADD CONSTRAINT FK_E655E3A75200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_camping ADD CONSTRAINT FK_A878F2085DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_camping ADD CONSTRAINT FK_A878F2083CC6385 FOREIGN KEY (camping_id) REFERENCES camping (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE randonne ADD CONSTRAINT FK_1F7063F3A500A924 FOREIGN KEY (gerant_id) REFERENCES gerant (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription_camping DROP FOREIGN KEY FK_A878F2083CC6385');
        $this->addSql('ALTER TABLE inscription_club DROP FOREIGN KEY FK_995843C161190A32');
        $this->addSql('ALTER TABLE inscription_event DROP FOREIGN KEY FK_69E75EEA71F7E88B');
        $this->addSql('ALTER TABLE inscription_formation DROP FOREIGN KEY FK_E655E3A75200282E');
        $this->addSql('ALTER TABLE camping DROP FOREIGN KEY FK_81A904E4A500A924');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE387261190A32');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7A500A924');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFA500A924');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A500A924');
        $this->addSql('ALTER TABLE randonne DROP FOREIGN KEY FK_1F7063F3A500A924');
        $this->addSql('ALTER TABLE inscription_user DROP FOREIGN KEY FK_AC25ADFA5DAC5993');
        $this->addSql('ALTER TABLE inscription_club DROP FOREIGN KEY FK_995843C15DAC5993');
        $this->addSql('ALTER TABLE inscription_event DROP FOREIGN KEY FK_69E75EEA5DAC5993');
        $this->addSql('ALTER TABLE inscription_randonne DROP FOREIGN KEY FK_B6E51C565DAC5993');
        $this->addSql('ALTER TABLE inscription_formation DROP FOREIGN KEY FK_E655E3A75DAC5993');
        $this->addSql('ALTER TABLE inscription_camping DROP FOREIGN KEY FK_A878F2085DAC5993');
        $this->addSql('ALTER TABLE inscription_randonne DROP FOREIGN KEY FK_B6E51C56CF1641FE');
        $this->addSql('ALTER TABLE inscription_user DROP FOREIGN KEY FK_AC25ADFAA76ED395');
        $this->addSql('DROP TABLE camping');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE gerant');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE inscription_user');
        $this->addSql('DROP TABLE inscription_club');
        $this->addSql('DROP TABLE inscription_event');
        $this->addSql('DROP TABLE inscription_randonne');
        $this->addSql('DROP TABLE inscription_formation');
        $this->addSql('DROP TABLE inscription_camping');
        $this->addSql('DROP TABLE randonne');
        $this->addSql('DROP TABLE user');
    }
}
