<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220406185944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `like` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, Ыscreenshot_id INT DEFAULT NULL, INDEX IDX_AC6340B3A76ED395 (user_id), INDEX IDX_AC6340B3531DCB9B (Ыscreenshot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE screenshot (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, upload_date DATETIME NOT NULL, uuid VARCHAR(30) NOT NULL, path_to_source VARCHAR(255) NOT NULL, extension VARCHAR(20) NOT NULL, description VARCHAR(100) NOT NULL, INDEX IDX_58991E41A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3531DCB9B FOREIGN KEY (Ыscreenshot_id) REFERENCES screenshot (id)');
        $this->addSql('ALTER TABLE screenshot ADD CONSTRAINT FK_58991E41A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3531DCB9B');
        $this->addSql('DROP TABLE `like`');
        $this->addSql('DROP TABLE screenshot');
    }
}
