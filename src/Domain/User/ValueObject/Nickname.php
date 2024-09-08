<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\User\ValueObject\Interface\ValidateUniqueInterface;
use App\Domain\User\ValueObject\Interface\ValueObjectInterface;

class Nickname implements ValueObjectInterface, ValidateUniqueInterface
{

    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 35;

    public function __construct(
        private readonly string $value,
        private readonly array $nicknames
    )
    {
        $this->validateUnique($this->value, $nicknames);
    }

    public function validateUnique($value, array $elements): void
    {
        if (in_array($value, $elements)) {
            throw new \Exception('Nickname is not unique');
        }
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