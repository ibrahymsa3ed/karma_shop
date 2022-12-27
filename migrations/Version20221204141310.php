<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221204141310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders_products (id INT AUTO_INCREMENT NOT NULL, price_id INT DEFAULT NULL, product_qty INT NOT NULL, INDEX IDX_749C879CD614C7E7 (price_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders_products ADD CONSTRAINT FK_749C879CD614C7E7 FOREIGN KEY (price_id) REFERENCES prices (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders_products DROP FOREIGN KEY FK_749C879CD614C7E7');
        $this->addSql('DROP TABLE orders_products');
    }
}
