<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

class Password
{
    public const MIN_LENGTH = 8;
    public const MAX_LENGTH = 11;

    /**
     * @throws \Exception
     */
    public function __construct(
        public readonly string $value
    )
    {
        $this->validatePassword($this->value);
    }

    /**
     * @param string $password
     * @return void
     * @throws \Exception
     */
    private function validatePassword(string $password): void
    {
        $passwordLength = strlen($password);

        if ($passwordLength < self::MIN_LENGTH || $passwordLength > self::MAX_LENGTH) {
            throw new \Exception('Wrong password length');
        }
    }
}