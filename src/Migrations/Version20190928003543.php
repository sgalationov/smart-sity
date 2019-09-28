<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190928003543 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE unit_history (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_73F37E89F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendor (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_F52233F6F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', password VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, surname VARCHAR(255) DEFAULT NULL, post VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, vendor_id INT DEFAULT NULL, author_id INT NOT NULL, name VARCHAR(255) NOT NULL, cost DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_D79572D9F603EE73 (vendor_id), INDEX IDX_D79572D9F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit (id INT AUTO_INCREMENT NOT NULL, layer_id INT NOT NULL, parent_id INT DEFAULT NULL, model_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, power_consumption DOUBLE PRECISION DEFAULT NULL, power_generation DOUBLE PRECISION DEFAULT NULL, bandwidth DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, unit_condition DOUBLE PRECISION DEFAULT NULL, INDEX IDX_DCBB0C53EA6EFDCD (layer_id), INDEX IDX_DCBB0C53727ACA70 (parent_id), INDEX IDX_DCBB0C537975B7E7 (model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit_image (unit_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_4E0F7A54F8BD700D (unit_id), INDEX IDX_4E0F7A543DA5256D (image_id), PRIMARY KEY(unit_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, unit_id INT NOT NULL, executor_id INT DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, date DATETIME DEFAULT NULL, status INT NOT NULL, plan_date DATETIME DEFAULT NULL, fact_date DATETIME DEFAULT NULL, INDEX IDX_527EDB25F8BD700D (unit_id), INDEX IDX_527EDB258ABD09BB (executor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE layer (id INT AUTO_INCREMENT NOT NULL, unit_id INT DEFAULT NULL, author_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_E4DB211AF8BD700D (unit_id), INDEX IDX_E4DB211AF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE device (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, INDEX IDX_92FB68EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organization (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, original_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE energy_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE unit_history ADD CONSTRAINT FK_73F37E89F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vendor ADD CONSTRAINT FK_F52233F6F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D9F603EE73 FOREIGN KEY (vendor_id) REFERENCES vendor (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D9F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE unit ADD CONSTRAINT FK_DCBB0C53EA6EFDCD FOREIGN KEY (layer_id) REFERENCES layer (id)');
        $this->addSql('ALTER TABLE unit ADD CONSTRAINT FK_DCBB0C53727ACA70 FOREIGN KEY (parent_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE unit ADD CONSTRAINT FK_DCBB0C537975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE unit_image ADD CONSTRAINT FK_4E0F7A54F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE unit_image ADD CONSTRAINT FK_4E0F7A543DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB258ABD09BB FOREIGN KEY (executor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE layer ADD CONSTRAINT FK_E4DB211AF8BD700D FOREIGN KEY (unit_id) REFERENCES energy_type (id)');
        $this->addSql('ALTER TABLE layer ADD CONSTRAINT FK_E4DB211AF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D9F603EE73');
        $this->addSql('ALTER TABLE unit_history DROP FOREIGN KEY FK_73F37E89F675F31B');
        $this->addSql('ALTER TABLE vendor DROP FOREIGN KEY FK_F52233F6F675F31B');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D9F675F31B');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB258ABD09BB');
        $this->addSql('ALTER TABLE layer DROP FOREIGN KEY FK_E4DB211AF675F31B');
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68EA76ED395');
        $this->addSql('ALTER TABLE unit DROP FOREIGN KEY FK_DCBB0C537975B7E7');
        $this->addSql('ALTER TABLE unit DROP FOREIGN KEY FK_DCBB0C53727ACA70');
        $this->addSql('ALTER TABLE unit_image DROP FOREIGN KEY FK_4E0F7A54F8BD700D');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25F8BD700D');
        $this->addSql('ALTER TABLE unit DROP FOREIGN KEY FK_DCBB0C53EA6EFDCD');
        $this->addSql('ALTER TABLE unit_image DROP FOREIGN KEY FK_4E0F7A543DA5256D');
        $this->addSql('ALTER TABLE layer DROP FOREIGN KEY FK_E4DB211AF8BD700D');
        $this->addSql('DROP TABLE unit_history');
        $this->addSql('DROP TABLE vendor');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE unit_image');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE layer');
        $this->addSql('DROP TABLE device');
        $this->addSql('DROP TABLE organization');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE energy_type');
    }
}
