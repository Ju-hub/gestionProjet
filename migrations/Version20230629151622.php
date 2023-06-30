<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629151622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tasks_user (tasks_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_677C783FE3272D31 (tasks_id), INDEX IDX_677C783FA76ED395 (user_id), PRIMARY KEY(tasks_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tasks_user ADD CONSTRAINT FK_677C783FE3272D31 FOREIGN KEY (tasks_id) REFERENCES tasks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tasks_user ADD CONSTRAINT FK_677C783FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A4E3272D31');
        $this->addSql('DROP INDEX IDX_5C93B3A4E3272D31 ON projects');
        $this->addSql('ALTER TABLE projects DROP tasks_id');
        $this->addSql('ALTER TABLE tasks ADD projects_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tasks ADD CONSTRAINT FK_505865971EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id)');
        $this->addSql('CREATE INDEX IDX_505865971EDE0F55 ON tasks (projects_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E3272D31');
        $this->addSql('DROP INDEX IDX_8D93D649E3272D31 ON user');
        $this->addSql('ALTER TABLE user DROP tasks_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tasks_user DROP FOREIGN KEY FK_677C783FE3272D31');
        $this->addSql('ALTER TABLE tasks_user DROP FOREIGN KEY FK_677C783FA76ED395');
        $this->addSql('DROP TABLE tasks_user');
        $this->addSql('ALTER TABLE projects ADD tasks_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A4E3272D31 FOREIGN KEY (tasks_id) REFERENCES tasks (id)');
        $this->addSql('CREATE INDEX IDX_5C93B3A4E3272D31 ON projects (tasks_id)');
        $this->addSql('ALTER TABLE tasks DROP FOREIGN KEY FK_505865971EDE0F55');
        $this->addSql('DROP INDEX IDX_505865971EDE0F55 ON tasks');
        $this->addSql('ALTER TABLE tasks DROP projects_id');
        $this->addSql('ALTER TABLE `user` ADD tasks_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649E3272D31 FOREIGN KEY (tasks_id) REFERENCES tasks (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649E3272D31 ON `user` (tasks_id)');
    }
}
