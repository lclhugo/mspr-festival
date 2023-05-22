<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522123536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA711F56659');
        $this->addSql('DROP INDEX IDX_3BAE0AA711F56659 ON event');
        $this->addSql('ALTER TABLE event CHANGE festival_id_id festival_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA78AEBAF57 FOREIGN KEY (festival_id) REFERENCES festival (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA78AEBAF57 ON event (festival_id)');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA11F56659');
        $this->addSql('DROP INDEX IDX_BF5476CA11F56659 ON notification');
        $this->addSql('ALTER TABLE notification CHANGE festival_id_id festival_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA8AEBAF57 FOREIGN KEY (festival_id) REFERENCES festival (id)');
        $this->addSql('CREATE INDEX IDX_BF5476CA8AEBAF57 ON notification (festival_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA8AEBAF57');
        $this->addSql('DROP INDEX IDX_BF5476CA8AEBAF57 ON notification');
        $this->addSql('ALTER TABLE notification CHANGE festival_id festival_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA11F56659 FOREIGN KEY (festival_id_id) REFERENCES festival (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BF5476CA11F56659 ON notification (festival_id_id)');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA78AEBAF57');
        $this->addSql('DROP INDEX IDX_3BAE0AA78AEBAF57 ON event');
        $this->addSql('ALTER TABLE event CHANGE festival_id festival_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA711F56659 FOREIGN KEY (festival_id_id) REFERENCES festival (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3BAE0AA711F56659 ON event (festival_id_id)');
    }
}
