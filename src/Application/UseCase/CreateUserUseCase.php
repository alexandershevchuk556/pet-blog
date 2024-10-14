<?php

namespace App\Application\UseCase;

use App\Application\UseCase\Request\CreateUserRequest;
use App\Application\UseCase\Response\CreateUserResponse;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\{Id, Email, Password, Nickname};
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserUseCase
{
    public function __construct(
        private UserRepositoryInterface     $doctrineOrmUserRepository,
        private UserPasswordHasherInterface $passwordHasher
    )
    {

    }

    public function __invoke(
        #[MapRequestPayload] CreateUserRequest $userDto,
    ): CreateUserResponse
    {

        $lastUserId = $this->doctrineOrmUserRepository->findOneBy([], ['id' => 'DESC'])->getId();

        $domainUser = new User(
            new Id($lastUserId),
            new Email($userDto->email),
            new Password($userDto->password),
            new Nickname($userDto->nickname)
        );

        $this->doctrineOrmUserRepository->create($domainUser, $this->passwordHasher);
        return new CreateUserResponse('User created', 201);
    }
}