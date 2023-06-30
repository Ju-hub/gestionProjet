<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629140252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tasks_projects (tasks_id INT NOT NULL, projects_id INT NOT NULL, INDEX IDX_5818D8CBE3272D31 (tasks_id), INDEX IDX_5818D8CB1EDE0F55 (projects_id), PRIMARY KEY(tasks_id, projects_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tasks_projects ADD CONSTRAINT FK_5818D8CBE3272D31 FOREIGN KEY (tasks_id) REFERENCES tasks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tasks_projects ADD CONSTRAINT FK_5818D8CB1EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tasks_projects DROP FOREIGN KEY FK_5818D8CBE3272D31');
        $this->addSql('ALTER TABLE tasks_projects DROP FOREIGN KEY FK_5818D8CB1EDE0F55');
        $this->addSql('DROP TABLE tasks_projects');
    }
}
