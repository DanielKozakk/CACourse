<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211006120308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hotel_room_booking (id INT AUTO_INCREMENT NOT NULL, hotel_room_booking_history_id INT DEFAULT NULL, event_creation_date_time DATETIME NOT NULL, tenant_id VARCHAR(255) NOT NULL, days LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_A721A22DA8E91463 (hotel_room_booking_history_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel_room_booking_history (id INT AUTO_INCREMENT NOT NULL, hotel_room_id INT DEFAULT NULL, hotel_booking_history_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_EF42B1E3875D6EBA (hotel_room_id), INDEX IDX_EF42B1E380071F4C (hotel_booking_history_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hotel_room_booking ADD CONSTRAINT FK_A721A22DA8E91463 FOREIGN KEY (hotel_room_booking_history_id) REFERENCES hotel_room_booking_history (id)');
        $this->addSql('ALTER TABLE hotel_room_booking_history ADD CONSTRAINT FK_EF42B1E3875D6EBA FOREIGN KEY (hotel_room_id) REFERENCES hotel_room (id)');
        $this->addSql('ALTER TABLE hotel_room_booking_history ADD CONSTRAINT FK_EF42B1E380071F4C FOREIGN KEY (hotel_booking_history_id) REFERENCES hotel_booking_history (id)');
        $this->addSql('ALTER TABLE hotel_booking_history ADD id INT AUTO_INCREMENT NOT NULL, CHANGE hotel_id hotel_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CC4A87063243BB18 ON hotel_booking_history (hotel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hotel_room_booking DROP FOREIGN KEY FK_A721A22DA8E91463');
        $this->addSql('DROP TABLE hotel_room_booking');
        $this->addSql('DROP TABLE hotel_room_booking_history');
        $this->addSql('ALTER TABLE hotel_booking_history MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_CC4A87063243BB18 ON hotel_booking_history');
        $this->addSql('ALTER TABLE hotel_booking_history DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE hotel_booking_history DROP id, CHANGE hotel_id hotel_id INT NOT NULL');
        $this->addSql('ALTER TABLE hotel_booking_history ADD PRIMARY KEY (hotel_id)');
    }
}
