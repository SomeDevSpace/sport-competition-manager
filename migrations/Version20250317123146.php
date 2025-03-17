<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250317123146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competition ADD sport_id INT NOT NULL');
        $this->addSql('ALTER TABLE
          competition
        ADD
          CONSTRAINT FK_B50A2CB1AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B50A2CB1AC78BCF8 ON competition (sport_id)');
        $this->addSql('ALTER TABLE discipline ADD sport_id INT NOT NULL');
        $this->addSql('ALTER TABLE discipline ALTER unit TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE
          discipline
        ADD
          CONSTRAINT FK_75BEEE3FAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_75BEEE3FAC78BCF8 ON discipline (sport_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE competition DROP CONSTRAINT FK_B50A2CB1AC78BCF8');
        $this->addSql('DROP INDEX IDX_B50A2CB1AC78BCF8');
        $this->addSql('ALTER TABLE competition DROP sport_id');
        $this->addSql('ALTER TABLE discipline DROP CONSTRAINT FK_75BEEE3FAC78BCF8');
        $this->addSql('DROP INDEX IDX_75BEEE3FAC78BCF8');
        $this->addSql('ALTER TABLE discipline DROP sport_id');
        $this->addSql('ALTER TABLE discipline ALTER unit TYPE VARCHAR(5)');
    }
}
