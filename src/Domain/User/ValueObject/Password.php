<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\User\ValueObject\Interface\ValueObjectInterface;

class Password implements ValueObjectInterface
{
    /**
     * @throws \Exception
     */
    public function __construct(
        public readonly string $value
    )
    {
    }

    function getValue(): string
    {
        return $this->value;
    }
}