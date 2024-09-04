<?php

declare(strict_types=1);

namespace App\Domain\ValueObject\Interface;

interface ValidateUniqueInterface
{
    function validateUnique($value, array $elements);
}