<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005104706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE space (id INT AUTO_INCREMENT NOT NULL, hotel_room_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, square_meter_size DOUBLE PRECISION NOT NULL, INDEX IDX_2972C13A875D6EBA (hotel_room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE space ADD CONSTRAINT FK_2972C13A875D6EBA FOREIGN KEY (hotel_room_id) REFERENCES hotel_room (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE space');
    }
}
