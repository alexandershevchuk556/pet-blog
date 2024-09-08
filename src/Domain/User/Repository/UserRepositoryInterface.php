<?php

declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\Id;

interface UserRepositoryInterface
{
    public function findOneById(Id $id): ?User;

    public function findAll();

    public function save(User $user): void;
}