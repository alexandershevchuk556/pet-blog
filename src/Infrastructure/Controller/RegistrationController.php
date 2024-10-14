<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\UseCase\CreateUserUseCase;
use App\Application\UseCase\Request\CreateUserRequest;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Infrastructure\Service\RegistrationControllerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    public function __construct(
        private CreateUserUseCase       $createUserUseCase
    )
    {
    }

    #[Route('/user', methods: ['POST'])]
    public function index(
        #[MapRequestPayload] CreateUserRequest $requestDto,
    ): JsonResponse
    {
        try {
            ($this->createUserUseCase)($requestDto);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
                'code'    => 409
            ], 409);
        }

        return new JsonResponse([
            'message' => 'User successfully created',
            'code'    => 201
        ], 201);
    }
}