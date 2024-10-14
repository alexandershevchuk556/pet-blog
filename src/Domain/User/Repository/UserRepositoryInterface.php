<?php

declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\Id;
use Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

interface UserRepositoryInterface
{
    public function findOneById(int $id): ?User;

    public function findAll();

    public function save(User $user): void;

    public function create(User $user, UserPasswordHasherInterface $passwordHasher): void;
}