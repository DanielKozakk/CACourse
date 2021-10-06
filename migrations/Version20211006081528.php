<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211006081528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apartment_booking (id INT AUTO_INCREMENT NOT NULL, apartment_booking_history_id INT DEFAULT NULL, booking_creation DATETIME NOT NULL, owner_id VARCHAR(255) NOT NULL, tenant_id VARCHAR(255) NOT NULL, booking_period_start_date DATETIME NOT NULL, booking_period_end_date DATETIME NOT NULL, booking_step_state VARCHAR(255) NOT NULL, INDEX IDX_6C3A035462459E37 (apartment_booking_history_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apartment_booking_history (id INT AUTO_INCREMENT NOT NULL, apartment_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_4A55C810176DFE85 (apartment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apartment_booking ADD CONSTRAINT FK_6C3A035462459E37 FOREIGN KEY (apartment_booking_history_id) REFERENCES apartment_booking_history (id)');
        $this->addSql('ALTER TABLE apartment_booking_history ADD CONSTRAINT FK_4A55C810176DFE85 FOREIGN KEY (apartment_id) REFERENCES apartment (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apartment_booking DROP FOREIGN KEY FK_6C3A035462459E37');
        $this->addSql('DROP TABLE apartment_booking');
        $this->addSql('DROP TABLE apartment_booking_history');
    }
}
