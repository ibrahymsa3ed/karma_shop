<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221204145651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders_products ADD orders_id INT NOT NULL, ADD products_id INT NOT NULL');
        $this->addSql('ALTER TABLE orders_products ADD CONSTRAINT FK_749C879CCFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders_products ADD CONSTRAINT FK_749C879C6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id)');
        $this->addSql('CREATE INDEX IDX_749C879CCFFE9AD6 ON orders_products (orders_id)');
        $this->addSql('CREATE INDEX IDX_749C879C6C8A81A9 ON orders_products (products_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders_products DROP FOREIGN KEY FK_749C879CCFFE9AD6');
        $this->addSql('ALTER TABLE orders_products DROP FOREIGN KEY FK_749C879C6C8A81A9');
        $this->addSql('DROP INDEX IDX_749C879CCFFE9AD6 ON orders_products');
        $this->addSql('DROP INDEX IDX_749C879C6C8A81A9 ON orders_products');
        $this->addSql('ALTER TABLE orders_products DROP orders_id, DROP products_id');
    }
}
