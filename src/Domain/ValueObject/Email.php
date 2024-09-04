<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\ValueObject\Interface\ValidateUniqueInterface;

readonly class Email implements ValidateUniqueInterface
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
     * @param $email
     * @return void
     * @throws \Exception
     */
    private function validateEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Email is not valid');
        }
    }

    public function validateUnique($value, array $elements)
    {
        if (in_array($value, $elements)) {
            throw new \Exception('Email is not unique');
        }
    }
}