<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515125910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_festival (user_id INT NOT NULL, festival_id INT NOT NULL, INDEX IDX_E5F11389A76ED395 (user_id), INDEX IDX_E5F113898AEBAF57 (festival_id), PRIMARY KEY(user_id, festival_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_festival ADD CONSTRAINT FK_E5F11389A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_festival ADD CONSTRAINT FK_E5F113898AEBAF57 FOREIGN KEY (festival_id) REFERENCES festival (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_festival DROP FOREIGN KEY FK_E5F11389A76ED395');
        $this->addSql('ALTER TABLE user_festival DROP FOREIGN KEY FK_E5F113898AEBAF57');
        $this->addSql('DROP TABLE user_festival');
    }
}
