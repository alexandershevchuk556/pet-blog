<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\User\ValueObject\Interface\ValidateUniqueInterface;
use App\Domain\User\ValueObject\Interface\ValueObjectInterface;

class Email implements ValueObjectInterface
{
    /**
     * @throws \Exception
     */
    public function __construct(
        public string $value
    )
    {
        $this->validateEmail($this->value);
    }

    /**
     * @param string $email
     * @return void
     * @throws \Exception
     */
    private function validateEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Email is not valid');
        }
    }

    function getValue(): string
    {
        return $this->value;
    }
}