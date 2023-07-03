<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230703101559 extends AbstractMigration
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
        $this->addSql('ALTER TABLE user_tasks DROP FOREIGN KEY FK_B29A9ECFA76ED395');
        $this->addSql('ALTER TABLE user_tasks DROP FOREIGN KEY FK_B29A9ECFE3272D31');
        $this->addSql('DROP TABLE user_tasks');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_tasks (user_id INT NOT NULL, tasks_id INT NOT NULL, INDEX IDX_B29A9ECFA76ED395 (user_id), INDEX IDX_B29A9ECFE3272D31 (tasks_id), PRIMARY KEY(user_id, tasks_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_tasks ADD CONSTRAINT FK_B29A9ECFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_tasks ADD CONSTRAINT FK_B29A9ECFE3272D31 FOREIGN KEY (tasks_id) REFERENCES tasks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tasks_user DROP FOREIGN KEY FK_677C783FE3272D31');
        $this->addSql('ALTER TABLE tasks_user DROP FOREIGN KEY FK_677C783FA76ED395');
        $this->addSql('DROP TABLE tasks_user');
    }
}
