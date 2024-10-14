<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241006185714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('CREATE TABLE "User" (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nickname VARCHAR(180) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2DA17977E7927C74 ON "User" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2DA17977A188FE64 ON "User" (nickname)');
        $this->addSql('DROP TABLE users');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE users (id BIGINT DEFAULT users_id_seq NOT NULL, email VARCHAR NOT NULL, password VARCHAR(255) NOT NULL, nickname VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX users_nickname_key ON users (nickname)');
        $this->addSql('CREATE UNIQUE INDEX users_email_key ON users (email)');
        $this->addSql('DROP TABLE "User"');
    }
}
