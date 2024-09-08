<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\User\ValueObject\Interface\ValueObjectInterface;

class Password implements ValueObjectInterface
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
            throw new \Exception('Password length must be between ' . self::MIN_LENGTH . ' and ' . self::MAX_LENGTH);
        }
    }

    function getValue(): string
    {
        return $this->value;
    }
}