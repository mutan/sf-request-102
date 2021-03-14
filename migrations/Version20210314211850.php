<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210314211850 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nfl_team (id INT NOT NULL, key VARCHAR(255) NOT NULL, team_id INT NOT NULL, city VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, conference VARCHAR(255) DEFAULT NULL, division VARCHAR(255) DEFAULT NULL, full_name VARCHAR(255) DEFAULT NULL, head_coach VARCHAR(255) DEFAULT NULL, offensive_scheme VARCHAR(10) DEFAULT NULL, defensive_scheme VARCHAR(10) DEFAULT NULL, logo_url VARCHAR(255) DEFAULT NULL, word_mark_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_68F4FA07296CD8AE ON nfl_team (team_id)');
        $this->addSql('CREATE TABLE warehouse (id INT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, active BOOLEAN DEFAULT \'true\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ECB38BFC77153098 ON warehouse (code)');
        $this->addSql('COMMENT ON TABLE warehouse IS \'Склады\'');
        $this->addSql('COMMENT ON COLUMN warehouse.code IS \'Код склада\'');
        $this->addSql('COMMENT ON COLUMN warehouse.name IS \'Название склада\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE nfl_team');
        $this->addSql('DROP TABLE warehouse');
    }
}
