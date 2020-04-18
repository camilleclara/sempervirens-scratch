<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200417191307 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE choix ADD question_id INT DEFAULT NULL, ADD reponse_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE choix ADD CONSTRAINT FK_4F4880911E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE choix ADD CONSTRAINT FK_4F488091CF18BB82 FOREIGN KEY (reponse_id) REFERENCES reponse (id)');
        $this->addSql('ALTER TABLE choix ADD CONSTRAINT FK_4F488091A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4F4880911E27F6BF ON choix (question_id)');
        $this->addSql('CREATE INDEX IDX_4F488091CF18BB82 ON choix (reponse_id)');
        $this->addSql('CREATE INDEX IDX_4F488091A76ED395 ON choix (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE choix DROP FOREIGN KEY FK_4F4880911E27F6BF');
        $this->addSql('ALTER TABLE choix DROP FOREIGN KEY FK_4F488091CF18BB82');
        $this->addSql('ALTER TABLE choix DROP FOREIGN KEY FK_4F488091A76ED395');
        $this->addSql('DROP INDEX IDX_4F4880911E27F6BF ON choix');
        $this->addSql('DROP INDEX IDX_4F488091CF18BB82 ON choix');
        $this->addSql('DROP INDEX IDX_4F488091A76ED395 ON choix');
        $this->addSql('ALTER TABLE choix DROP question_id, DROP reponse_id, DROP user_id');
    }
}
