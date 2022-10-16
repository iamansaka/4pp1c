<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221016125002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table pets';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pets (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, registry_number VARCHAR(100) DEFAULT NULL, description LONGTEXT DEFAULT NULL, sexe TINYINT(1) NOT NULL, age INT DEFAULT NULL, arrived_at_refuge DATE NOT NULL, is_vaccinated TINYINT(1) NOT NULL, is_sterilized TINYINT(1) NOT NULL, is_affinity_dog TINYINT(1) NOT NULL, is_affinity_cat TINYINT(1) NOT NULL, is_affinity_children TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pets');
    }
}
