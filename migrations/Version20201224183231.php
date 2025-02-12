<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201224183231 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE387261190A32');
        $this->addSql('DROP INDEX IDX_B8EE387261190A32 ON club');
        $this->addSql('ALTER TABLE club CHANGE club_id gerant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE3872A500A924 FOREIGN KEY (gerant_id) REFERENCES gerant (id)');
        $this->addSql('CREATE INDEX IDX_B8EE3872A500A924 ON club (gerant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE3872A500A924');
        $this->addSql('DROP INDEX IDX_B8EE3872A500A924 ON club');
        $this->addSql('ALTER TABLE club CHANGE gerant_id club_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE387261190A32 FOREIGN KEY (club_id) REFERENCES gerant (id)');
        $this->addSql('CREATE INDEX IDX_B8EE387261190A32 ON club (club_id)');
    }
}
