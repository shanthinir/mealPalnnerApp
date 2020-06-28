<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200628155451 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE shopping_list_pantry_item (shopping_list_id INT NOT NULL, pantry_item_id INT NOT NULL, INDEX IDX_32352FAD23245BF9 (shopping_list_id), INDEX IDX_32352FADCA901B5F (pantry_item_id), PRIMARY KEY(shopping_list_id, pantry_item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shopping_list_pantry_item ADD CONSTRAINT FK_32352FAD23245BF9 FOREIGN KEY (shopping_list_id) REFERENCES shopping_list (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shopping_list_pantry_item ADD CONSTRAINT FK_32352FADCA901B5F FOREIGN KEY (pantry_item_id) REFERENCES pantry_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shopping_list ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shopping_list ADD CONSTRAINT FK_3DC1A459A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3DC1A459A76ED395 ON shopping_list (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE shopping_list_pantry_item');
        $this->addSql('ALTER TABLE shopping_list DROP FOREIGN KEY FK_3DC1A459A76ED395');
        $this->addSql('DROP INDEX IDX_3DC1A459A76ED395 ON shopping_list');
        $this->addSql('ALTER TABLE shopping_list DROP user_id');
    }
}
