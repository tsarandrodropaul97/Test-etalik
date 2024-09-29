<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240927195910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attributes_types DROP FOREIGN KEY FK_F9F4181E36421AD6');
        $this->addSql('DROP INDEX IDX_F9F4181E36421AD6 ON attributes_types');
        $this->addSql('ALTER TABLE attributes_types DROP input_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attributes_types ADD input_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE attributes_types ADD CONSTRAINT FK_F9F4181E36421AD6 FOREIGN KEY (input_id) REFERENCES input (id)');
        $this->addSql('CREATE INDEX IDX_F9F4181E36421AD6 ON attributes_types (input_id)');
    }
}
