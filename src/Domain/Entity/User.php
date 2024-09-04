<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Id;
use App\Domain\ValueObject\Password;

class User
{
    public function __construct(
        public readonly Id    $id,
        public readonly Email $email,
        public Password       $password,
        public string         $name,

    )
    {
    }
}