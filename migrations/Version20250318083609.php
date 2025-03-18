<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250318083609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE category ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN category.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN category.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE club ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE club ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE club ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN club.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN club.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8EE3872989D9B62 ON club (slug)');
        $this->addSql('ALTER TABLE club_section ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE club_section ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN club_section.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN club_section.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE competition ADD sport_id INT NOT NULL');
        $this->addSql('ALTER TABLE competition ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE competition ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE competition ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE competition ADD status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE competition ADD is_open_for_registration BOOLEAN NOT NULL');
        $this->addSql('COMMENT ON COLUMN competition.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN competition.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE
          competition
        ADD
          CONSTRAINT FK_B50A2CB1AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B50A2CB1989D9B62 ON competition (slug)');
        $this->addSql('CREATE INDEX IDX_B50A2CB1AC78BCF8 ON competition (sport_id)');
        $this->addSql('ALTER TABLE competition_discipline ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE competition_discipline ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN competition_discipline.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN competition_discipline.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE
          competition_discipline_category
        ADD
          created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE
          competition_discipline_category
        ADD
          updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN competition_discipline_category.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN competition_discipline_category.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE discipline ADD sport_id INT NOT NULL');
        $this->addSql('ALTER TABLE discipline ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE discipline ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE discipline ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE discipline ALTER unit TYPE VARCHAR(255)');
        $this->addSql('COMMENT ON COLUMN discipline.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN discipline.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE
          discipline
        ADD
          CONSTRAINT FK_75BEEE3FAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_75BEEE3F989D9B62 ON discipline (slug)');
        $this->addSql('CREATE INDEX IDX_75BEEE3FAC78BCF8 ON discipline (sport_id)');
        $this->addSql('ALTER TABLE player ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE player ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE player ADD email VARCHAR(255) NOT NULL');
        $this->addSql('COMMENT ON COLUMN player.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN player.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE player_club_section ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE player_club_section ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE player_club_section ADD license_no VARCHAR(255) DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN player_club_section.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN player_club_section.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE registration ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE registration ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN registration.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN registration.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE sport ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE sport ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN sport.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN sport.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE "user" ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "user".updated_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP created_at');
        $this->addSql('ALTER TABLE "user" DROP updated_at');
        $this->addSql('DROP INDEX UNIQ_B8EE3872989D9B62');
        $this->addSql('ALTER TABLE club DROP slug');
        $this->addSql('ALTER TABLE club DROP created_at');
        $this->addSql('ALTER TABLE club DROP updated_at');
        $this->addSql('ALTER TABLE club_section DROP created_at');
        $this->addSql('ALTER TABLE club_section DROP updated_at');
        $this->addSql('ALTER TABLE sport DROP created_at');
        $this->addSql('ALTER TABLE sport DROP updated_at');
        $this->addSql('ALTER TABLE competition DROP CONSTRAINT FK_B50A2CB1AC78BCF8');
        $this->addSql('DROP INDEX UNIQ_B50A2CB1989D9B62');
        $this->addSql('DROP INDEX IDX_B50A2CB1AC78BCF8');
        $this->addSql('ALTER TABLE competition DROP sport_id');
        $this->addSql('ALTER TABLE competition DROP slug');
        $this->addSql('ALTER TABLE competition DROP created_at');
        $this->addSql('ALTER TABLE competition DROP updated_at');
        $this->addSql('ALTER TABLE competition DROP status');
        $this->addSql('ALTER TABLE competition DROP is_open_for_registration');
        $this->addSql('ALTER TABLE competition_discipline DROP created_at');
        $this->addSql('ALTER TABLE competition_discipline DROP updated_at');
        $this->addSql('ALTER TABLE discipline DROP CONSTRAINT FK_75BEEE3FAC78BCF8');
        $this->addSql('DROP INDEX UNIQ_75BEEE3F989D9B62');
        $this->addSql('DROP INDEX IDX_75BEEE3FAC78BCF8');
        $this->addSql('ALTER TABLE discipline DROP sport_id');
        $this->addSql('ALTER TABLE discipline DROP slug');
        $this->addSql('ALTER TABLE discipline DROP created_at');
        $this->addSql('ALTER TABLE discipline DROP updated_at');
        $this->addSql('ALTER TABLE discipline ALTER unit TYPE VARCHAR(5)');
        $this->addSql('ALTER TABLE competition_discipline_category DROP created_at');
        $this->addSql('ALTER TABLE competition_discipline_category DROP updated_at');
        $this->addSql('ALTER TABLE category DROP created_at');
        $this->addSql('ALTER TABLE category DROP updated_at');
        $this->addSql('ALTER TABLE player DROP created_at');
        $this->addSql('ALTER TABLE player DROP updated_at');
        $this->addSql('ALTER TABLE player DROP email');
        $this->addSql('ALTER TABLE player_club_section DROP created_at');
        $this->addSql('ALTER TABLE player_club_section DROP updated_at');
        $this->addSql('ALTER TABLE player_club_section DROP license_no');
        $this->addSql('ALTER TABLE registration DROP created_at');
        $this->addSql('ALTER TABLE registration DROP updated_at');
    }
}
