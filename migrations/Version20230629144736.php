<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629144736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projects ADD tasks_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A4E3272D31 FOREIGN KEY (tasks_id) REFERENCES tasks (id)');
        $this->addSql('CREATE INDEX IDX_5C93B3A4E3272D31 ON projects (tasks_id)');
        $this->addSql('ALTER TABLE tasks DROP FOREIGN KEY FK_50586597A7E5433');
        $this->addSql('DROP INDEX IDX_50586597A7E5433 ON tasks');
        $this->addSql('ALTER TABLE tasks DROP task_project_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A4E3272D31');
        $this->addSql('DROP INDEX IDX_5C93B3A4E3272D31 ON projects');
        $this->addSql('ALTER TABLE projects DROP tasks_id');
        $this->addSql('ALTER TABLE tasks ADD task_project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tasks ADD CONSTRAINT FK_50586597A7E5433 FOREIGN KEY (task_project_id) REFERENCES tasks (id)');
        $this->addSql('CREATE INDEX IDX_50586597A7E5433 ON tasks (task_project_id)');
    }
}
