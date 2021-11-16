<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211116071706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apartment_booking_history_read_model (id INT NOT NULL, apartment_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_AE58AEF7176DFE85 (apartment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apartment_booking_read_model (id INT NOT NULL, apartment_booking_history_read_model_id INT DEFAULT NULL, booking_creation DATETIME NOT NULL, owner_id VARCHAR(255) NOT NULL, tenant_id VARCHAR(255) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, booking_step VARCHAR(255) NOT NULL, INDEX IDX_F455146883FEE86A (apartment_booking_history_read_model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apartment_booking_history_read_model ADD CONSTRAINT FK_AE58AEF7176DFE85 FOREIGN KEY (apartment_id) REFERENCES apartment_read_model (id)');
        $this->addSql('ALTER TABLE apartment_booking_read_model ADD CONSTRAINT FK_F455146883FEE86A FOREIGN KEY (apartment_booking_history_read_model_id) REFERENCES apartment_booking_history_read_model (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apartment_booking_read_model DROP FOREIGN KEY FK_F455146883FEE86A');
        $this->addSql('DROP TABLE apartment_booking_history_read_model');
        $this->addSql('DROP TABLE apartment_booking_read_model');
    }
}
