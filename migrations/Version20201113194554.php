<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201113194554 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, machine_id INT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', type VARCHAR(280) NOT NULL, url VARCHAR(280) NOT NULL, UNIQUE INDEX UNIQ_C53D045FD17F50A6 (uuid), INDEX IDX_C53D045FF6B75B26 (machine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE machine (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', brand VARCHAR(280) NOT NULL, model VARCHAR(280) NOT NULL, manufacturer VARCHAR(280) NOT NULL, price DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_1505DF84D17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FF6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FF6B75B26');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE machine');
    }
}
