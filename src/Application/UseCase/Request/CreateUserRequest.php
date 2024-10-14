<?php

declare(strict_types=1);

namespace App\Application\UseCase\Request;

use Symfony\Component\Validator\Constraints;

class CreateUserRequest
{
    public function __construct(
        #[Constraints\NotBlank]
        public string $nickname,

        #[Constraints\NotBlank]
        #[Constraints\Email]
        public string $email,

        #[Constraints\NotBlank]
        public string $password,
    ) {
    }
}