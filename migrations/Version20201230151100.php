<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201230151100 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE camping ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE camping ADD CONSTRAINT FK_81A904E4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_81A904E4A76ED395 ON camping (user_id)');
        $this->addSql('ALTER TABLE club ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE3872A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B8EE3872A76ED395 ON club (user_id)');
        $this->addSql('ALTER TABLE event ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7A76ED395 ON event (user_id)');
        $this->addSql('ALTER TABLE formation ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_404021BFA76ED395 ON formation (user_id)');
        $this->addSql('ALTER TABLE randonne ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE randonne ADD CONSTRAINT FK_1F7063F3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1F7063F3A76ED395 ON randonne (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE camping DROP FOREIGN KEY FK_81A904E4A76ED395');
        $this->addSql('DROP INDEX IDX_81A904E4A76ED395 ON camping');
        $this->addSql('ALTER TABLE camping DROP user_id');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE3872A76ED395');
        $this->addSql('DROP INDEX IDX_B8EE3872A76ED395 ON club');
        $this->addSql('ALTER TABLE club DROP user_id');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7A76ED395');
        $this->addSql('DROP INDEX IDX_3BAE0AA7A76ED395 ON event');
        $this->addSql('ALTER TABLE event DROP user_id');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFA76ED395');
        $this->addSql('DROP INDEX IDX_404021BFA76ED395 ON formation');
        $this->addSql('ALTER TABLE formation DROP user_id');
        $this->addSql('ALTER TABLE randonne DROP FOREIGN KEY FK_1F7063F3A76ED395');
        $this->addSql('DROP INDEX IDX_1F7063F3A76ED395 ON randonne');
        $this->addSql('ALTER TABLE randonne DROP user_id');
    }
}
