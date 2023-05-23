<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523113951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA71F48AE04');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7918DB72');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA79777D11E');
        $this->addSql('DROP INDEX IDX_3BAE0AA7918DB72 ON event');
        $this->addSql('DROP INDEX IDX_3BAE0AA79777D11E ON event');
        $this->addSql('DROP INDEX IDX_3BAE0AA71F48AE04 ON event');
        $this->addSql('ALTER TABLE event ADD artist_id INT DEFAULT NULL, ADD category_id INT DEFAULT NULL, ADD location_id INT DEFAULT NULL, DROP artist_id_id, DROP category_id_id, DROP location_id_id');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA712469DE2 FOREIGN KEY (category_id) REFERENCES event_category (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA764D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7B7970CF8 ON event (artist_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA712469DE2 ON event (category_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA764D218E ON event (location_id)');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB9777D11E');
        $this->addSql('DROP INDEX IDX_5E9E89CB9777D11E ON location');
        $this->addSql('ALTER TABLE location CHANGE category_id_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB12469DE2 FOREIGN KEY (category_id) REFERENCES location_category (id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CB12469DE2 ON location (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB12469DE2');
        $this->addSql('DROP INDEX IDX_5E9E89CB12469DE2 ON location');
        $this->addSql('ALTER TABLE location CHANGE category_id category_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB9777D11E FOREIGN KEY (category_id_id) REFERENCES location_category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5E9E89CB9777D11E ON location (category_id_id)');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7B7970CF8');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA712469DE2');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA764D218E');
        $this->addSql('DROP INDEX IDX_3BAE0AA7B7970CF8 ON event');
        $this->addSql('DROP INDEX IDX_3BAE0AA712469DE2 ON event');
        $this->addSql('DROP INDEX IDX_3BAE0AA764D218E ON event');
        $this->addSql('ALTER TABLE event ADD artist_id_id INT DEFAULT NULL, ADD category_id_id INT DEFAULT NULL, ADD location_id_id INT DEFAULT NULL, DROP artist_id, DROP category_id, DROP location_id');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA71F48AE04 FOREIGN KEY (artist_id_id) REFERENCES artist (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7918DB72 FOREIGN KEY (location_id_id) REFERENCES location (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA79777D11E FOREIGN KEY (category_id_id) REFERENCES event_category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7918DB72 ON event (location_id_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA79777D11E ON event (category_id_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA71F48AE04 ON event (artist_id_id)');
    }
}
