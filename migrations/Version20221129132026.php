<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221129132026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE addresses (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, address VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL, is_default TINYINT(1) NOT NULL, INDEX IDX_6FCA7516A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, user_id INT DEFAULT NULL, comment LONGTEXT DEFAULT NULL, date DATE NOT NULL, INDEX IDX_5F9E962A4584665A (product_id), INDEX IDX_5F9E962AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mobiles (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, mobile_number VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, is_default TINYINT(1) NOT NULL, INDEX IDX_BB385E50A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, user_id INT DEFAULT NULL, address_id INT DEFAULT NULL, mobile_id INT DEFAULT NULL, invoice_num VARCHAR(255) DEFAULT NULL, date DATE NOT NULL, total DOUBLE PRECISION NOT NULL, INDEX IDX_E52FFDEE4584665A (product_id), INDEX IDX_E52FFDEEA76ED395 (user_id), INDEX IDX_E52FFDEEF5B7AF75 (address_id), INDEX IDX_E52FFDEEB806424B (mobile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prices (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, reason VARCHAR(255) DEFAULT NULL, date_from DATE DEFAULT NULL, date_to DATE DEFAULT NULL, INDEX IDX_E4CB6D594584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reviews (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, user_id INT DEFAULT NULL, rate DOUBLE PRECISION DEFAULT NULL, text LONGTEXT DEFAULT NULL, date DATE NOT NULL, INDEX IDX_6970EB0F4584665A (product_id), INDEX IDX_6970EB0FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, item_price DOUBLE PRECISION NOT NULL, reason VARCHAR(255) DEFAULT NULL, qty DOUBLE PRECISION DEFAULT NULL, shipping_date DATE DEFAULT NULL, in_or_out VARCHAR(255) DEFAULT NULL, INDEX IDX_4B3656604584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, full_name VARCHAR(255) DEFAULT NULL, date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE addresses ADD CONSTRAINT FK_6FCA7516A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A4584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE mobiles ADD CONSTRAINT FK_BB385E50A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE4584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEF5B7AF75 FOREIGN KEY (address_id) REFERENCES addresses (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEB806424B FOREIGN KEY (mobile_id) REFERENCES mobiles (id)');
        $this->addSql('ALTER TABLE prices ADD CONSTRAINT FK_E4CB6D594584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0F4584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0FA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656604584665A FOREIGN KEY (product_id) REFERENCES products (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE addresses DROP FOREIGN KEY FK_6FCA7516A76ED395');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A4584665A');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AA76ED395');
        $this->addSql('ALTER TABLE mobiles DROP FOREIGN KEY FK_BB385E50A76ED395');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE4584665A');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEF5B7AF75');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEB806424B');
        $this->addSql('ALTER TABLE prices DROP FOREIGN KEY FK_E4CB6D594584665A');
        $this->addSql('ALTER TABLE reviews DROP FOREIGN KEY FK_6970EB0F4584665A');
        $this->addSql('ALTER TABLE reviews DROP FOREIGN KEY FK_6970EB0FA76ED395');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656604584665A');
        $this->addSql('DROP TABLE addresses');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE mobiles');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE prices');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE users');
    }
}
