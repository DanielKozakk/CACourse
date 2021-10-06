<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211006131830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apartment (id INT AUTO_INCREMENT NOT NULL, owner_id VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, address_street VARCHAR(255) NOT NULL, address_postal_code VARCHAR(255) NOT NULL, address_house_number VARCHAR(255) NOT NULL, address_apartment_number VARCHAR(255) NOT NULL, address_city VARCHAR(255) NOT NULL, address_country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apartment_booking (id INT AUTO_INCREMENT NOT NULL, apartment_booking_history_id INT DEFAULT NULL, booking_creation DATETIME NOT NULL, owner_id VARCHAR(255) NOT NULL, tenant_id VARCHAR(255) NOT NULL, booking_period_start_date DATETIME NOT NULL, booking_period_end_date DATETIME NOT NULL, booking_step_state VARCHAR(255) NOT NULL, INDEX IDX_6C3A035462459E37 (apartment_booking_history_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apartment_booking_history (id INT AUTO_INCREMENT NOT NULL, apartment_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_4A55C810176DFE85 (apartment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apartment_read_model (id INT NOT NULL, owner_id VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, house_number VARCHAR(255) NOT NULL, apartment_number VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, rental_place_id VARCHAR(255) NOT NULL, tenant_id VARCHAR(255) NOT NULL, days LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', rental_type_state VARCHAR(255) NOT NULL, booking_status_state VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address_street VARCHAR(255) NOT NULL, address_building_number VARCHAR(255) NOT NULL, address_postal_code VARCHAR(255) NOT NULL, address_city VARCHAR(255) NOT NULL, address_country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel_booking_history (id INT AUTO_INCREMENT NOT NULL, hotel_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_CC4A87063243BB18 (hotel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel_read_model (id INT NOT NULL, name VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, building_number VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel_room (id INT AUTO_INCREMENT NOT NULL, hotel_id INT DEFAULT NULL, hotel_room_number INT NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_C55A87133243BB18 (hotel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel_room_booking (id INT AUTO_INCREMENT NOT NULL, hotel_room_booking_history_id INT DEFAULT NULL, event_creation_date_time DATETIME NOT NULL, tenant_id VARCHAR(255) NOT NULL, days LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_A721A22DA8E91463 (hotel_room_booking_history_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel_room_booking_history (id INT AUTO_INCREMENT NOT NULL, hotel_room_id INT DEFAULT NULL, hotel_booking_history_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_EF42B1E3875D6EBA (hotel_room_id), INDEX IDX_EF42B1E380071F4C (hotel_booking_history_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel_room_read_model (id INT NOT NULL, hotel_id VARCHAR(255) NOT NULL, hotel_room_number INT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, apartment_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, square_meter_size DOUBLE PRECISION NOT NULL, INDEX IDX_729F519B176DFE85 (apartment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_read_model (id INT AUTO_INCREMENT NOT NULL, apartment_read_model_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, size DOUBLE PRECISION NOT NULL, INDEX IDX_BCE77E1188679417 (apartment_read_model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space (id INT AUTO_INCREMENT NOT NULL, hotel_room_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, square_meter_size DOUBLE PRECISION NOT NULL, INDEX IDX_2972C13A875D6EBA (hotel_room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space_read_model (id INT NOT NULL, hotel_room_read_model_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, square_meter DOUBLE PRECISION NOT NULL, INDEX IDX_8E8A1A5CF3EFD707 (hotel_room_read_model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apartment_booking ADD CONSTRAINT FK_6C3A035462459E37 FOREIGN KEY (apartment_booking_history_id) REFERENCES apartment_booking_history (id)');
        $this->addSql('ALTER TABLE apartment_booking_history ADD CONSTRAINT FK_4A55C810176DFE85 FOREIGN KEY (apartment_id) REFERENCES apartment (id)');
        $this->addSql('ALTER TABLE hotel_booking_history ADD CONSTRAINT FK_CC4A87063243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE hotel_room ADD CONSTRAINT FK_C55A87133243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE hotel_room_booking ADD CONSTRAINT FK_A721A22DA8E91463 FOREIGN KEY (hotel_room_booking_history_id) REFERENCES hotel_room_booking_history (id)');
        $this->addSql('ALTER TABLE hotel_room_booking_history ADD CONSTRAINT FK_EF42B1E3875D6EBA FOREIGN KEY (hotel_room_id) REFERENCES hotel_room (id)');
        $this->addSql('ALTER TABLE hotel_room_booking_history ADD CONSTRAINT FK_EF42B1E380071F4C FOREIGN KEY (hotel_booking_history_id) REFERENCES hotel_booking_history (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B176DFE85 FOREIGN KEY (apartment_id) REFERENCES apartment (id)');
        $this->addSql('ALTER TABLE room_read_model ADD CONSTRAINT FK_BCE77E1188679417 FOREIGN KEY (apartment_read_model_id) REFERENCES apartment_read_model (id)');
        $this->addSql('ALTER TABLE space ADD CONSTRAINT FK_2972C13A875D6EBA FOREIGN KEY (hotel_room_id) REFERENCES hotel_room (id)');
        $this->addSql('ALTER TABLE space_read_model ADD CONSTRAINT FK_8E8A1A5CF3EFD707 FOREIGN KEY (hotel_room_read_model_id) REFERENCES hotel_room_read_model (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apartment_booking_history DROP FOREIGN KEY FK_4A55C810176DFE85');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B176DFE85');
        $this->addSql('ALTER TABLE apartment_booking DROP FOREIGN KEY FK_6C3A035462459E37');
        $this->addSql('ALTER TABLE room_read_model DROP FOREIGN KEY FK_BCE77E1188679417');
        $this->addSql('ALTER TABLE hotel_booking_history DROP FOREIGN KEY FK_CC4A87063243BB18');
        $this->addSql('ALTER TABLE hotel_room DROP FOREIGN KEY FK_C55A87133243BB18');
        $this->addSql('ALTER TABLE hotel_room_booking_history DROP FOREIGN KEY FK_EF42B1E380071F4C');
        $this->addSql('ALTER TABLE hotel_room_booking_history DROP FOREIGN KEY FK_EF42B1E3875D6EBA');
        $this->addSql('ALTER TABLE space DROP FOREIGN KEY FK_2972C13A875D6EBA');
        $this->addSql('ALTER TABLE hotel_room_booking DROP FOREIGN KEY FK_A721A22DA8E91463');
        $this->addSql('ALTER TABLE space_read_model DROP FOREIGN KEY FK_8E8A1A5CF3EFD707');
        $this->addSql('DROP TABLE apartment');
        $this->addSql('DROP TABLE apartment_booking');
        $this->addSql('DROP TABLE apartment_booking_history');
        $this->addSql('DROP TABLE apartment_read_model');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE hotel_booking_history');
        $this->addSql('DROP TABLE hotel_read_model');
        $this->addSql('DROP TABLE hotel_room');
        $this->addSql('DROP TABLE hotel_room_booking');
        $this->addSql('DROP TABLE hotel_room_booking_history');
        $this->addSql('DROP TABLE hotel_room_read_model');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE room_read_model');
        $this->addSql('DROP TABLE space');
        $this->addSql('DROP TABLE space_read_model');
    }
}
