<?php

declare(strict_types=1);

namespace App\Application\UseCase\Response;

class CreateUserResponse
{
    public function __construct(
        public string $message,
        public string $code,
    ) {
    }
}