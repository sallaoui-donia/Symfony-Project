<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210105100908 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inscription_club (inscription_id INT NOT NULL, club_id INT NOT NULL, INDEX IDX_995843C15DAC5993 (inscription_id), INDEX IDX_995843C161190A32 (club_id), PRIMARY KEY(inscription_id, club_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_camping (inscription_id INT NOT NULL, camping_id INT NOT NULL, INDEX IDX_A878F2085DAC5993 (inscription_id), INDEX IDX_A878F2083CC6385 (camping_id), PRIMARY KEY(inscription_id, camping_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_randonne (inscription_id INT NOT NULL, randonne_id INT NOT NULL, INDEX IDX_B6E51C565DAC5993 (inscription_id), INDEX IDX_B6E51C56CF1641FE (randonne_id), PRIMARY KEY(inscription_id, randonne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_event (inscription_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_69E75EEA5DAC5993 (inscription_id), INDEX IDX_69E75EEA71F7E88B (event_id), PRIMARY KEY(inscription_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_formation (inscription_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_E655E3A75DAC5993 (inscription_id), INDEX IDX_E655E3A75200282E (formation_id), PRIMARY KEY(inscription_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inscription_club ADD CONSTRAINT FK_995843C15DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_club ADD CONSTRAINT FK_995843C161190A32 FOREIGN KEY (club_id) REFERENCES club (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_camping ADD CONSTRAINT FK_A878F2085DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_camping ADD CONSTRAINT FK_A878F2083CC6385 FOREIGN KEY (camping_id) REFERENCES camping (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_randonne ADD CONSTRAINT FK_B6E51C565DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_randonne ADD CONSTRAINT FK_B6E51C56CF1641FE FOREIGN KEY (randonne_id) REFERENCES randonne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_event ADD CONSTRAINT FK_69E75EEA5DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_event ADD CONSTRAINT FK_69E75EEA71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_formation ADD CONSTRAINT FK_E655E3A75DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_formation ADD CONSTRAINT FK_E655E3A75200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6A76ED395 ON inscription (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE inscription_club');
        $this->addSql('DROP TABLE inscription_camping');
        $this->addSql('DROP TABLE inscription_randonne');
        $this->addSql('DROP TABLE inscription_event');
        $this->addSql('DROP TABLE inscription_formation');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A76ED395');
        $this->addSql('DROP INDEX IDX_5E90F6D6A76ED395 ON inscription');
        $this->addSql('ALTER TABLE inscription DROP user_id');
    }
}
