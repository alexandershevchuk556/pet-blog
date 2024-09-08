<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240907104822 extends AbstractMigration
{

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE EXTENSION citext');
        $this->addSql('CREATE TABLE users (id BIGSERIAL PRIMARY KEY, email citext UNIQUE NOT NULL, password VARCHAR(255) NOT NULL, nickname VARCHAR(255) UNIQUE NOT NULL)');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP EXTENSION IF EXISTS citext');
        $this->addSql('DROP TABLE users');
    }
}
