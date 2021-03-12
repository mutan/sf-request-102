<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210312220035 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE nflteam_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE nfl_team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE nfl_team (id INT NOT NULL, key VARCHAR(255) NOT NULL, team_id INT NOT NULL, city VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, conference VARCHAR(255) DEFAULT NULL, division VARCHAR(255) DEFAULT NULL, full_name VARCHAR(255) DEFAULT NULL, head_coach VARCHAR(255) DEFAULT NULL, offensive_scheme VARCHAR(10) DEFAULT NULL, defensive_scheme VARCHAR(10) DEFAULT NULL, logo_url VARCHAR(255) DEFAULT NULL, word_mark_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE nfl_team_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE nflteam_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP TABLE nfl_team');
    }
}
