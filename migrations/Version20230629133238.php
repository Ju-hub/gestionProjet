<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629133238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_projects (user_id INT NOT NULL, projects_id INT NOT NULL, INDEX IDX_BC1E57A4A76ED395 (user_id), INDEX IDX_BC1E57A41EDE0F55 (projects_id), PRIMARY KEY(user_id, projects_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_projects ADD CONSTRAINT FK_BC1E57A4A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_projects ADD CONSTRAINT FK_BC1E57A41EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491EDE0F55');
        $this->addSql('DROP INDEX IDX_8D93D6491EDE0F55 ON user');
        $this->addSql('ALTER TABLE user DROP projects_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_projects DROP FOREIGN KEY FK_BC1E57A4A76ED395');
        $this->addSql('ALTER TABLE user_projects DROP FOREIGN KEY FK_BC1E57A41EDE0F55');
        $this->addSql('DROP TABLE user_projects');
        $this->addSql('ALTER TABLE `user` ADD projects_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6491EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6491EDE0F55 ON `user` (projects_id)');
    }
}
