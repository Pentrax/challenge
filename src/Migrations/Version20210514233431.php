<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210514233431 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE catalog (id INT AUTO_INCREMENT NOT NULL, state LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, catalog_id INT NOT NULL, style_number VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, amount INT DEFAULT NULL, currency VARCHAR(5) DEFAULT NULL, images LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_B3BA5A5ACC3C66FC (catalog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5ACC3C66FC FOREIGN KEY (catalog_id) REFERENCES catalog (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `sg`.`catalog` CHANGE COLUMN `state` `state` VARCHAR(10) NOT NULL ');
//        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5ACC3C66FC');
//        $this->addSql('DROP TABLE catalog');
//        $this->addSql('DROP TABLE products');
    }
}
