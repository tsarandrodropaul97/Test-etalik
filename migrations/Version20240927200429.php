<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240927200429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attributes_types ADD type_id INT DEFAULT NULL, DROP type');
        $this->addSql('ALTER TABLE attributes_types ADD CONSTRAINT FK_F9F4181EC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_F9F4181EC54C8C93 ON attributes_types (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attributes_types DROP FOREIGN KEY FK_F9F4181EC54C8C93');
        $this->addSql('DROP INDEX IDX_F9F4181EC54C8C93 ON attributes_types');
        $this->addSql('ALTER TABLE attributes_types ADD type VARCHAR(255) NOT NULL, DROP type_id');
    }
}
