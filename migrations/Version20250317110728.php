<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250317110728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (
          id SERIAL NOT NULL,
          name VARCHAR(100) NOT NULL,
          description TEXT DEFAULT NULL,
          min_age INT DEFAULT NULL,
          max_age INT DEFAULT NULL,
          gender VARCHAR(255) DEFAULT NULL,
          PRIMARY KEY(id)
        )');
        $this->addSql('CREATE TABLE club (
          id SERIAL NOT NULL,
          name VARCHAR(200) NOT NULL,
          city VARCHAR(100) NOT NULL,
          PRIMARY KEY(id)
        )');
        $this->addSql('CREATE TABLE club_section (
          id SERIAL NOT NULL,
          club_id INT NOT NULL,
          sport_id INT NOT NULL,
          PRIMARY KEY(id)
        )');
        $this->addSql('CREATE INDEX IDX_203BDF6D61190A32 ON club_section (club_id)');
        $this->addSql('CREATE INDEX IDX_203BDF6DAC78BCF8 ON club_section (sport_id)');
        $this->addSql('CREATE TABLE competition (
          id SERIAL NOT NULL,
          name VARCHAR(200) NOT NULL,
          start_date DATE NOT NULL,
          end_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
          format VARCHAR(255) NOT NULL,
          location VARCHAR(200) NOT NULL,
          description TEXT NOT NULL,
          PRIMARY KEY(id)
        )');
        $this->addSql('CREATE TABLE competition_discipline (
          id SERIAL NOT NULL,
          competition_id INT NOT NULL,
          discipline_id INT NOT NULL,
          entry_fee DOUBLE PRECISION NOT NULL,
          other_info TEXT DEFAULT NULL,
          PRIMARY KEY(id)
        )');
        $this->addSql('CREATE INDEX IDX_D6A90E077B39D312 ON competition_discipline (competition_id)');
        $this->addSql('CREATE INDEX IDX_D6A90E07A5522701 ON competition_discipline (discipline_id)');
        $this->addSql('CREATE TABLE competition_discipline_category (
          id SERIAL NOT NULL,
          competition_discipline_id INT NOT NULL,
          category_id INT NOT NULL,
          entry_fee DOUBLE PRECISION DEFAULT NULL,
          other_info TEXT DEFAULT NULL,
          PRIMARY KEY(id)
        )');
        $this->addSql('CREATE INDEX IDX_4F334AD55287E5A1 ON competition_discipline_category (competition_discipline_id)');
        $this->addSql('CREATE INDEX IDX_4F334AD512469DE2 ON competition_discipline_category (category_id)');
        $this->addSql('CREATE TABLE discipline (
          id SERIAL NOT NULL,
          name VARCHAR(100) NOT NULL,
          description TEXT DEFAULT NULL,
          unit VARCHAR(5) NOT NULL,
          PRIMARY KEY(id)
        )');
        $this->addSql('CREATE TABLE player (
          id SERIAL NOT NULL,
          first_name VARCHAR(100) NOT NULL,
          last_name VARCHAR(100) NOT NULL,
          birth_date DATE NOT NULL,
          gender VARCHAR(255) NOT NULL,
          PRIMARY KEY(id)
        )');
        $this->addSql('CREATE TABLE player_club_section (
          id SERIAL NOT NULL,
          player_id INT NOT NULL,
          club_section_id INT DEFAULT NULL,
          PRIMARY KEY(id)
        )');
        $this->addSql('CREATE INDEX IDX_A0068F4F99E6F5DF ON player_club_section (player_id)');
        $this->addSql('CREATE INDEX IDX_A0068F4F91E5AD97 ON player_club_section (club_section_id)');
        $this->addSql('CREATE TABLE registration (
          id SERIAL NOT NULL,
          competition_discipline_id INT NOT NULL,
          player_club_section_id INT NOT NULL,
          start_number VARCHAR(10) DEFAULT NULL,
          is_paid BOOLEAN NOT NULL,
          paid_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL,
          payment_method VARCHAR(255) DEFAULT NULL,
          registration_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
          PRIMARY KEY(id)
        )');
        $this->addSql('CREATE INDEX IDX_62A8A7A75287E5A1 ON registration (competition_discipline_id)');
        $this->addSql('CREATE INDEX IDX_62A8A7A748FF2EDC ON registration (player_club_section_id)');
        $this->addSql('CREATE TABLE sport (id SERIAL NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE
          club_section
        ADD
          CONSTRAINT FK_203BDF6D61190A32 FOREIGN KEY (club_id) REFERENCES club (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE
          club_section
        ADD
          CONSTRAINT FK_203BDF6DAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE
          competition_discipline
        ADD
          CONSTRAINT FK_D6A90E077B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE
          competition_discipline
        ADD
          CONSTRAINT FK_D6A90E07A5522701 FOREIGN KEY (discipline_id) REFERENCES discipline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE
          competition_discipline_category
        ADD
          CONSTRAINT FK_4F334AD55287E5A1 FOREIGN KEY (competition_discipline_id) REFERENCES competition_discipline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE
          competition_discipline_category
        ADD
          CONSTRAINT FK_4F334AD512469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE
          player_club_section
        ADD
          CONSTRAINT FK_A0068F4F99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE
          player_club_section
        ADD
          CONSTRAINT FK_A0068F4F91E5AD97 FOREIGN KEY (club_section_id) REFERENCES club_section (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE
          registration
        ADD
          CONSTRAINT FK_62A8A7A75287E5A1 FOREIGN KEY (competition_discipline_id) REFERENCES competition_discipline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE
          registration
        ADD
          CONSTRAINT FK_62A8A7A748FF2EDC FOREIGN KEY (player_club_section_id) REFERENCES player_club_section (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE club_section DROP CONSTRAINT FK_203BDF6D61190A32');
        $this->addSql('ALTER TABLE club_section DROP CONSTRAINT FK_203BDF6DAC78BCF8');
        $this->addSql('ALTER TABLE competition_discipline DROP CONSTRAINT FK_D6A90E077B39D312');
        $this->addSql('ALTER TABLE competition_discipline DROP CONSTRAINT FK_D6A90E07A5522701');
        $this->addSql('ALTER TABLE competition_discipline_category DROP CONSTRAINT FK_4F334AD55287E5A1');
        $this->addSql('ALTER TABLE competition_discipline_category DROP CONSTRAINT FK_4F334AD512469DE2');
        $this->addSql('ALTER TABLE player_club_section DROP CONSTRAINT FK_A0068F4F99E6F5DF');
        $this->addSql('ALTER TABLE player_club_section DROP CONSTRAINT FK_A0068F4F91E5AD97');
        $this->addSql('ALTER TABLE registration DROP CONSTRAINT FK_62A8A7A75287E5A1');
        $this->addSql('ALTER TABLE registration DROP CONSTRAINT FK_62A8A7A748FF2EDC');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE club_section');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE competition_discipline');
        $this->addSql('DROP TABLE competition_discipline_category');
        $this->addSql('DROP TABLE discipline');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_club_section');
        $this->addSql('DROP TABLE registration');
        $this->addSql('DROP TABLE sport');
    }
}
