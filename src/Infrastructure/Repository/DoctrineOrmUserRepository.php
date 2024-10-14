<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\{Id, Email, Password, Nickname};
use App\Infrastructure\Orm\Entity\User as OrmUser;
use App\Domain\User\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Orm\EntityRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class DoctrineOrmUserRepository implements UserRepositoryInterface
{

    private EntityRepository $userOrmRepository;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $this->userOrmRepository = $this->entityManager->getRepository(OrmUser::class);
    }

    public function findOneById(int $id): ?User
    {
        $ormUser = $this->userOrmRepository->find($id);
        return new User(
            new Id($ormUser->getId()),
            new Email($ormUser->getEmail()),
            new Password($ormUser->getPassword()),
            new Nickname($ormUser->getNickname())
        );
    }

    public function findAll(): array
    {
        return $this->userOrmRepository->findAll();
    }

    public function save(User $userDto): void
    {
//
    }

    public function create(User $user, UserPasswordHasherInterface $passwordHasher): void
    {
        $userOrm = new OrmUser(
            $user->email->getValue(),
            $user->password->getValue(),
            $user->nickname->getValue(),
            $passwordHasher
        );

        $this->entityManager->persist($userOrm);
        $this->entityManager->flush();
    }

    public function findOneBy(array $criteria, array|null $orderBy = null): mixed
    {
        return $this->userOrmRepository->findOneBy($criteria, $orderBy);
    }
}