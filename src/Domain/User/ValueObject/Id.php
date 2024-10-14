<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\User\ValueObject\Interface\ValidateUniqueInterface;
use App\Domain\User\ValueObject\Interface\ValueObjectInterface;

class Id implements ValueObjectInterface
{
    public function __construct(
        public readonly int $value
    )
    {
    }

    function getValue(): int
    {
        return $this->value;
    }
}