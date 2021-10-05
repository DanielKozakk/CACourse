<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005085142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apartment (id INT AUTO_INCREMENT NOT NULL, owner_id VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, address_street VARCHAR(255) NOT NULL, address_postal_code VARCHAR(255) NOT NULL, address_house_number VARCHAR(255) NOT NULL, address_apartment_number VARCHAR(255) NOT NULL, address_city VARCHAR(255) NOT NULL, address_country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apartment_read_model (id INT NOT NULL, owner_id VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, house_number VARCHAR(255) NOT NULL, apartment_number VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, apartment_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, square_meter_size DOUBLE PRECISION NOT NULL, INDEX IDX_729F519B176DFE85 (apartment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_read_model (id INT AUTO_INCREMENT NOT NULL, apartment_read_model_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, size DOUBLE PRECISION NOT NULL, INDEX IDX_BCE77E1188679417 (apartment_read_model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B176DFE85 FOREIGN KEY (apartment_id) REFERENCES apartment (id)');
        $this->addSql('ALTER TABLE room_read_model ADD CONSTRAINT FK_BCE77E1188679417 FOREIGN KEY (apartment_read_model_id) REFERENCES apartment_read_model (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B176DFE85');
        $this->addSql('ALTER TABLE room_read_model DROP FOREIGN KEY FK_BCE77E1188679417');
        $this->addSql('DROP TABLE apartment');
        $this->addSql('DROP TABLE apartment_read_model');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE room_read_model');
    }
}
