<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\ValueObject\Interface\ValidateUniqueInterface;

class Id implements ValidateUniqueInterface
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
}