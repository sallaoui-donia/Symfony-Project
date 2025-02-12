<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210106131744 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription ADD club_id INT DEFAULT NULL, ADD formation_id INT DEFAULT NULL, ADD camping_id INT DEFAULT NULL, ADD event_id INT DEFAULT NULL, ADD randonne_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D661190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D65200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D63CC6385 FOREIGN KEY (camping_id) REFERENCES camping (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D671F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6CF1641FE FOREIGN KEY (randonne_id) REFERENCES randonne (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D661190A32 ON inscription (club_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D65200282E ON inscription (formation_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D63CC6385 ON inscription (camping_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D671F7E88B ON inscription (event_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6CF1641FE ON inscription (randonne_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D661190A32');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D65200282E');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D63CC6385');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D671F7E88B');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6CF1641FE');
        $this->addSql('DROP INDEX IDX_5E90F6D661190A32 ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D65200282E ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D63CC6385 ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D671F7E88B ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D6CF1641FE ON inscription');
        $this->addSql('ALTER TABLE inscription DROP club_id, DROP formation_id, DROP camping_id, DROP event_id, DROP randonne_id');
    }
}
