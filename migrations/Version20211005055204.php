<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005055204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apartment (id INT AUTO_INCREMENT NOT NULL, owner_id VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, address_street VARCHAR(255) NOT NULL, address_postal_code VARCHAR(255) NOT NULL, address_house_number VARCHAR(255) NOT NULL, address_apartment_number VARCHAR(255) NOT NULL, address_city VARCHAR(255) NOT NULL, address_country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apartment_read_model (id INT AUTO_INCREMENT NOT NULL, owner_id VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, house_number VARCHAR(255) NOT NULL, apartment_number VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE apartment');
        $this->addSql('DROP TABLE apartment_read_model');
    }
}
