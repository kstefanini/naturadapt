<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190321113357 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE naturadapt_categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE naturadapt_usergroups_memberships (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, usergroup_id INT NOT NULL, joined_at DATETIME NOT NULL, role VARCHAR(255) DEFAULT NULL, notifications_settings JSON DEFAULT NULL, INDEX IDX_39362F08A76ED395 (user_id), INDEX IDX_39362F08D2112630 (usergroup_id), UNIQUE INDEX user_usergroup (user_id, usergroup_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE naturadapt_files (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, usergroup_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, path VARCHAR(255) NOT NULL, type VARCHAR(50) DEFAULT NULL, size INT DEFAULT NULL, INDEX IDX_1922520BA76ED395 (user_id), INDEX IDX_1922520BD2112630 (usergroup_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE naturadapt_users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(100) NOT NULL, location VARCHAR(100) DEFAULT NULL, presentation LONGTEXT DEFAULT NULL, avatar VARCHAR(100) DEFAULT NULL, profile_visibility VARCHAR(100) DEFAULT NULL, locale VARCHAR(100) DEFAULT NULL, timezone VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, seen_at DATETIME DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_B94B7BBE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE naturadapt_pages (id INT AUTO_INCREMENT NOT NULL, usergroup_id INT NOT NULL, author_id INT NOT NULL, slug VARCHAR(100) NOT NULL, title VARCHAR(100) NOT NULL, body LONGTEXT NOT NULL, created_at DATETIME NOT NULL, edited_at DATETIME DEFAULT NULL, INDEX IDX_3F63F727D2112630 (usergroup_id), INDEX IDX_3F63F727F675F31B (author_id), INDEX slug (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE naturadapt_usergroups (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(100) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, presentation LONGTEXT DEFAULT NULL, visibility VARCHAR(10) NOT NULL, active_apps LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_F4679660989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE naturadapt_usergroups_categories (usergroup_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_86FA2E5BD2112630 (usergroup_id), INDEX IDX_86FA2E5B12469DE2 (category_id), PRIMARY KEY(usergroup_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE naturadapt_usergroups_memberships ADD CONSTRAINT FK_39362F08A76ED395 FOREIGN KEY (user_id) REFERENCES naturadapt_users (id)');
        $this->addSql('ALTER TABLE naturadapt_usergroups_memberships ADD CONSTRAINT FK_39362F08D2112630 FOREIGN KEY (usergroup_id) REFERENCES naturadapt_usergroups (id)');
        $this->addSql('ALTER TABLE naturadapt_files ADD CONSTRAINT FK_1922520BA76ED395 FOREIGN KEY (user_id) REFERENCES naturadapt_users (id)');
        $this->addSql('ALTER TABLE naturadapt_files ADD CONSTRAINT FK_1922520BD2112630 FOREIGN KEY (usergroup_id) REFERENCES naturadapt_usergroups (id)');
        $this->addSql('ALTER TABLE naturadapt_pages ADD CONSTRAINT FK_3F63F727D2112630 FOREIGN KEY (usergroup_id) REFERENCES naturadapt_usergroups (id)');
        $this->addSql('ALTER TABLE naturadapt_pages ADD CONSTRAINT FK_3F63F727F675F31B FOREIGN KEY (author_id) REFERENCES naturadapt_users (id)');
        $this->addSql('ALTER TABLE naturadapt_usergroups_categories ADD CONSTRAINT FK_86FA2E5BD2112630 FOREIGN KEY (usergroup_id) REFERENCES naturadapt_usergroups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE naturadapt_usergroups_categories ADD CONSTRAINT FK_86FA2E5B12469DE2 FOREIGN KEY (category_id) REFERENCES naturadapt_categories (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE naturadapt_usergroups_categories DROP FOREIGN KEY FK_86FA2E5B12469DE2');
        $this->addSql('ALTER TABLE naturadapt_usergroups_memberships DROP FOREIGN KEY FK_39362F08A76ED395');
        $this->addSql('ALTER TABLE naturadapt_files DROP FOREIGN KEY FK_1922520BA76ED395');
        $this->addSql('ALTER TABLE naturadapt_pages DROP FOREIGN KEY FK_3F63F727F675F31B');
        $this->addSql('ALTER TABLE naturadapt_usergroups_memberships DROP FOREIGN KEY FK_39362F08D2112630');
        $this->addSql('ALTER TABLE naturadapt_files DROP FOREIGN KEY FK_1922520BD2112630');
        $this->addSql('ALTER TABLE naturadapt_pages DROP FOREIGN KEY FK_3F63F727D2112630');
        $this->addSql('ALTER TABLE naturadapt_usergroups_categories DROP FOREIGN KEY FK_86FA2E5BD2112630');
        $this->addSql('DROP TABLE naturadapt_categories');
        $this->addSql('DROP TABLE naturadapt_usergroups_memberships');
        $this->addSql('DROP TABLE naturadapt_files');
        $this->addSql('DROP TABLE naturadapt_users');
        $this->addSql('DROP TABLE naturadapt_pages');
        $this->addSql('DROP TABLE naturadapt_usergroups');
        $this->addSql('DROP TABLE naturadapt_usergroups_categories');
    }
}
