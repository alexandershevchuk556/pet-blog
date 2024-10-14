<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Domain\User\Repository\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(private UserRepositoryInterface $doctrineOrmUserRepository)
    {
    }

    #[Route('/user', methods: ['GET'])]
    public function showUsers(): JsonResponse
    {
        $users = $this->doctrineOrmUserRepository->findAll();
        return new JsonResponse($users);
    }

    #[Route('/user/{id}', methods: ['GET'])]
    public function findById(int $id): JsonResponse
    {
        $user = $this->doctrineOrmUserRepository->findOneById($id);
        return new JsonResponse($user);
    }

}