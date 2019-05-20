<?php

declare(strict_types=1);

namespace App\Api\Shared\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190519222730 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE group_teams DROP FOREIGN KEY FK_C6EE093FFE54D947');
        $this->addSql('ALTER TABLE group_teams DROP FOREIGN KEY FK_C6EE093F296CD8AE');
        $this->addSql('DROP INDEX IDX_C6EE093FFE54D947 ON group_teams');
        $this->addSql('DROP INDEX IDX_C6EE093F296CD8AE ON group_teams');
        $this->addSql('ALTER TABLE group_teams ADD CONSTRAINT FK_C6EE093F296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_C6EE093FFE54D947 ON group_teams (group_id)');
        $this->addSql('CREATE INDEX IDX_C6EE093F296CD8AE ON group_teams (team_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE group_teams DROP FOREIGN KEY FK_C6EE093F296CD8AE');
        $this->addSql('ALTER TABLE group_teams DROP FOREIGN KEY FK_C6EE093FFE54D947');
        $this->addSql('DROP INDEX IDX_C6EE093FFE54D947 ON group_teams');
        $this->addSql('DROP INDEX IDX_C6EE093F296CD8AE ON group_teams');
        $this->addSql('ALTER TABLE group_teams ADD CONSTRAINT FK_C6EE093FFE54D947 FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_C6EE093FFE54D947 ON group_teams (team_id)');
        $this->addSql('CREATE INDEX IDX_C6EE093F296CD8AE ON group_teams (group_id)');
    }
}
