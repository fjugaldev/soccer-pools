<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190513135405 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE federation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, logo VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament_group (id INT AUTO_INCREMENT NOT NULL, tournament_id INT DEFAULT NULL, name VARCHAR(25) NOT NULL, group_letter VARCHAR(2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_AC96D4DC33D1A3E7 (tournament_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_teams (team_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_C6EE093F296CD8AE (team_id), INDEX IDX_C6EE093FFE54D947 (group_id), PRIMARY KEY(team_id, group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament (id INT AUTO_INCREMENT NOT NULL, federation_id INT DEFAULT NULL, name VARCHAR(120) NOT NULL, description LONGTEXT NOT NULL, from_date DATETIME NOT NULL, to_date DATETIME NOT NULL, logo VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_BD5FB8D96A03EFC5 (federation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament_teams (tournament_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_5794B24133D1A3E7 (tournament_id), INDEX IDX_5794B241296CD8AE (team_id), PRIMARY KEY(tournament_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pool_ticket (id INT AUTO_INCREMENT NOT NULL, pool_id INT DEFAULT NULL, match_id INT DEFAULT NULL, player_id INT DEFAULT NULL, visitor_score INT NOT NULL, home_score INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_4228D23D7B3406DF (pool_id), INDEX IDX_4228D23D2ABEACD6 (match_id), INDEX IDX_4228D23D99E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament_phase (id INT AUTO_INCREMENT NOT NULL, tournament_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_70EB46D233D1A3E7 (tournament_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, fifa_code VARCHAR(3) NOT NULL, iso2 VARCHAR(2) NOT NULL, flag VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament_pool (id INT AUTO_INCREMENT NOT NULL, tournament_id INT DEFAULT NULL, owner_id INT DEFAULT NULL, name VARCHAR(120) NOT NULL, description LONGTEXT NOT NULL, private TINYINT(1) NOT NULL, access_code VARCHAR(255) DEFAULT NULL, max_players INT NOT NULL, hit_victory_points INT NOT NULL, hit_tie_points INT NOT NULL, hit_score_points INT NOT NULL, hit_home_score_points INT NOT NULL, hit_visitor_score_points INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_981C1BB833D1A3E7 (tournament_id), INDEX IDX_981C1BB87E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament_pool_players (pool_id INT NOT NULL, player_id INT NOT NULL, INDEX IDX_A7AE09CC7B3406DF (pool_id), INDEX IDX_A7AE09CC99E6F5DF (player_id), PRIMARY KEY(pool_id, player_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament_match (id INT AUTO_INCREMENT NOT NULL, visitor_id INT DEFAULT NULL, home_id INT DEFAULT NULL, tournament_id INT DEFAULT NULL, group_id INT DEFAULT NULL, phase_id INT DEFAULT NULL, visitor_score INT NOT NULL, home_score INT NOT NULL, date DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_BB0D551C70BEE6D (visitor_id), INDEX IDX_BB0D551C28CDC89C (home_id), INDEX IDX_BB0D551C33D1A3E7 (tournament_id), INDEX IDX_BB0D551CFE54D947 (group_id), INDEX IDX_BB0D551C99091188 (phase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tournament_group ADD CONSTRAINT FK_AC96D4DC33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('ALTER TABLE group_teams ADD CONSTRAINT FK_C6EE093F296CD8AE FOREIGN KEY (group_id) REFERENCES tournament_group (id)');
        $this->addSql('ALTER TABLE group_teams ADD CONSTRAINT FK_C6EE093FFE54D947 FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT FK_BD5FB8D96A03EFC5 FOREIGN KEY (federation_id) REFERENCES federation (id)');
        $this->addSql('ALTER TABLE tournament_teams ADD CONSTRAINT FK_5794B24133D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('ALTER TABLE tournament_teams ADD CONSTRAINT FK_5794B241296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE pool_ticket ADD CONSTRAINT FK_4228D23D7B3406DF FOREIGN KEY (pool_id) REFERENCES tournament_pool (id)');
        $this->addSql('ALTER TABLE pool_ticket ADD CONSTRAINT FK_4228D23D2ABEACD6 FOREIGN KEY (match_id) REFERENCES tournament_match (id)');
        $this->addSql('ALTER TABLE pool_ticket ADD CONSTRAINT FK_4228D23D99E6F5DF FOREIGN KEY (player_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tournament_phase ADD CONSTRAINT FK_70EB46D233D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('ALTER TABLE tournament_pool ADD CONSTRAINT FK_981C1BB833D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('ALTER TABLE tournament_pool ADD CONSTRAINT FK_981C1BB87E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tournament_pool_players ADD CONSTRAINT FK_A7AE09CC7B3406DF FOREIGN KEY (pool_id) REFERENCES tournament_pool (id)');
        $this->addSql('ALTER TABLE tournament_pool_players ADD CONSTRAINT FK_A7AE09CC99E6F5DF FOREIGN KEY (player_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tournament_match ADD CONSTRAINT FK_BB0D551C70BEE6D FOREIGN KEY (visitor_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE tournament_match ADD CONSTRAINT FK_BB0D551C28CDC89C FOREIGN KEY (home_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE tournament_match ADD CONSTRAINT FK_BB0D551C33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('ALTER TABLE tournament_match ADD CONSTRAINT FK_BB0D551CFE54D947 FOREIGN KEY (group_id) REFERENCES tournament_group (id)');
        $this->addSql('ALTER TABLE tournament_match ADD CONSTRAINT FK_BB0D551C99091188 FOREIGN KEY (phase_id) REFERENCES tournament_phase (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tournament DROP FOREIGN KEY FK_BD5FB8D96A03EFC5');
        $this->addSql('ALTER TABLE group_teams DROP FOREIGN KEY FK_C6EE093F296CD8AE');
        $this->addSql('ALTER TABLE tournament_match DROP FOREIGN KEY FK_BB0D551CFE54D947');
        $this->addSql('ALTER TABLE tournament_group DROP FOREIGN KEY FK_AC96D4DC33D1A3E7');
        $this->addSql('ALTER TABLE tournament_teams DROP FOREIGN KEY FK_5794B24133D1A3E7');
        $this->addSql('ALTER TABLE tournament_phase DROP FOREIGN KEY FK_70EB46D233D1A3E7');
        $this->addSql('ALTER TABLE tournament_pool DROP FOREIGN KEY FK_981C1BB833D1A3E7');
        $this->addSql('ALTER TABLE tournament_match DROP FOREIGN KEY FK_BB0D551C33D1A3E7');
        $this->addSql('ALTER TABLE pool_ticket DROP FOREIGN KEY FK_4228D23D99E6F5DF');
        $this->addSql('ALTER TABLE tournament_pool DROP FOREIGN KEY FK_981C1BB87E3C61F9');
        $this->addSql('ALTER TABLE tournament_pool_players DROP FOREIGN KEY FK_A7AE09CC99E6F5DF');
        $this->addSql('ALTER TABLE tournament_match DROP FOREIGN KEY FK_BB0D551C99091188');
        $this->addSql('ALTER TABLE group_teams DROP FOREIGN KEY FK_C6EE093FFE54D947');
        $this->addSql('ALTER TABLE tournament_teams DROP FOREIGN KEY FK_5794B241296CD8AE');
        $this->addSql('ALTER TABLE tournament_match DROP FOREIGN KEY FK_BB0D551C70BEE6D');
        $this->addSql('ALTER TABLE tournament_match DROP FOREIGN KEY FK_BB0D551C28CDC89C');
        $this->addSql('ALTER TABLE pool_ticket DROP FOREIGN KEY FK_4228D23D7B3406DF');
        $this->addSql('ALTER TABLE tournament_pool_players DROP FOREIGN KEY FK_A7AE09CC7B3406DF');
        $this->addSql('ALTER TABLE pool_ticket DROP FOREIGN KEY FK_4228D23D2ABEACD6');
        $this->addSql('DROP TABLE federation');
        $this->addSql('DROP TABLE tournament_group');
        $this->addSql('DROP TABLE group_teams');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('DROP TABLE tournament_teams');
        $this->addSql('DROP TABLE pool_ticket');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE tournament_phase');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE tournament_pool');
        $this->addSql('DROP TABLE tournament_pool_players');
        $this->addSql('DROP TABLE tournament_match');
        $this->addSql('DROP TABLE refresh_tokens');
    }
}
