<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005111205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hotel_room_read_model (id INT NOT NULL, hotel_id VARCHAR(255) NOT NULL, hotel_room_number INT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space_read_model (id INT NOT NULL, hotel_room_read_model_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, square_meter DOUBLE PRECISION NOT NULL, INDEX IDX_8E8A1A5CF3EFD707 (hotel_room_read_model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE space_read_model ADD CONSTRAINT FK_8E8A1A5CF3EFD707 FOREIGN KEY (hotel_room_read_model_id) REFERENCES hotel_room_read_model (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE space_read_model DROP FOREIGN KEY FK_8E8A1A5CF3EFD707');
        $this->addSql('DROP TABLE hotel_room_read_model');
        $this->addSql('DROP TABLE space_read_model');
    }
}
