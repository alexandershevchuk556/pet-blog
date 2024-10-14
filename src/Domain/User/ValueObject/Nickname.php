<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\User\ValueObject\Interface\ValidateUniqueInterface;
use App\Domain\User\ValueObject\Interface\ValueObjectInterface;

class Nickname implements ValueObjectInterface
{

    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 35;

    public function __construct(
        private readonly string $value,
    )
    {
    }

    public function validateNickname(string $nickname): void
    {
        if (strlen($nickname) > self::MAX_LENGTH || strlen($nickname) < self::MIN_LENGTH){
            throw new \Exception('Nickname length must be between ' . self::MIN_LENGTH . ' and ' . self::MAX_LENGTH);
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}