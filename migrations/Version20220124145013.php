<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220124145013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout relation entre l\'entité clothes et l\'entité Category';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clothes_category (clothes_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_87DBE5F2271E85C0 (clothes_id), INDEX IDX_87DBE5F212469DE2 (category_id), PRIMARY KEY(clothes_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clothes_category ADD CONSTRAINT FK_87DBE5F2271E85C0 FOREIGN KEY (clothes_id) REFERENCES clothes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clothes_category ADD CONSTRAINT FK_87DBE5F212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE clothes_category');
    }
}
