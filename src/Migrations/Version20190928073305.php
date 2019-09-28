<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190928073305 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE layer DROP FOREIGN KEY FK_E4DB211AF8BD700D');
        $this->addSql('ALTER TABLE layer CHANGE unit_id energy_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE layer ADD CONSTRAINT FK_E4DB211A80726647 FOREIGN KEY (energy_type_id) REFERENCES energy_type (id)');
        $this->addSql('CREATE INDEX IDX_E4DB211A80726647 ON layer (energy_type_id)');
        $this->addSql('ALTER TABLE organization DROP test');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE layer DROP FOREIGN KEY FK_E4DB211A80726647');
        $this->addSql('DROP INDEX IDX_E4DB211A80726647 ON layer');
        $this->addSql('ALTER TABLE layer CHANGE energy_type_id unit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE layer ADD CONSTRAINT FK_E4DB211AF8BD700D FOREIGN KEY (unit_id) REFERENCES energy_type (id)');
        $this->addSql('CREATE INDEX IDX_E4DB211AF8BD700D ON layer (unit_id)');
        $this->addSql('ALTER TABLE organization ADD test VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE task ADD fact_datetest DATETIME DEFAULT NULL');
    }
}
