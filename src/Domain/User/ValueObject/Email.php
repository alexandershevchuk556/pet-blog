<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\User\ValueObject\Interface\ValidateUniqueInterface;
use App\Domain\User\ValueObject\Interface\ValueObjectInterface;

class Email implements ValidateUniqueInterface, ValueObjectInterface
{
    /**
     * @throws \Exception
     */
    public function __construct(
        public string $value,
        private array $emails
    )
    {
        $this->validateEmail($this->value);
        $this->validateUnique($this->value, $emails);
        unset($this->emails);
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

    public function validateUnique($value, array $elements)
    {
        if (in_array($value, $elements)) {
            throw new \Exception('Email is not unique');
        }
    }

    function getValue(): string
    {
        return $this->value;
    }
}