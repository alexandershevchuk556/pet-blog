<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\Id;
use Doctrine\DBAL\Connection;

class PostgresUserRepository implements UserRepositoryInterface
{
    public function __construct(private Connection $connection)
    {
    }

    public function findOneById(Id $id): ?User
    {
        $sql = 'SELECT * FROM users WHERE id = :id';
        return $this->connection->fetchOne($sql, $id);
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM users';
        return $this->connection->fetchAllAssociative($sql);
    }

    public function save(User $user): void
    {
        // soemthin somethine
    }
}