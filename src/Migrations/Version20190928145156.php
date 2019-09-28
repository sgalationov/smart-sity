<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190928145156 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE unit_history ADD unit_id INT NOT NULL');
        $this->addSql('ALTER TABLE unit_history ADD CONSTRAINT FK_73F37E89F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('CREATE INDEX IDX_73F37E89F8BD700D ON unit_history (unit_id)');
        $this->addSql('CREATE TABLE task_image (task_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_2991F7F8DB60186 (task_id), INDEX IDX_2991F7F3DA5256D (image_id), PRIMARY KEY(task_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE task_image ADD CONSTRAINT FK_2991F7F8DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_image ADD CONSTRAINT FK_2991F7F3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE unit ADD last_check_at DATETIME DEFAULT NULL, ADD service_interval INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE task_image');
        $this->addSql('ALTER TABLE unit DROP last_check_at, DROP service_interval');
    }
}
