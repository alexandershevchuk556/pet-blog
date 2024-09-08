<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\User\ValueObject\Interface\ValidateUniqueInterface;
use App\Domain\User\ValueObject\Interface\ValueObjectInterface;

class Id implements ValidateUniqueInterface, ValueObjectInterface
{
    public function __construct(
        public readonly int    $value,
        private readonly array $ids
    )
    {
        $this->validateUnique($value, $ids);
        unset($this->ids);
    }

    public function validateUnique($value, array $elements)
    {
        if (in_array($value, $elements)) {
            throw new \Exception('Id is not unique');
        }
    }

    function getValue(): int
    {
        return $this->value;
    }
}