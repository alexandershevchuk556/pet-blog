<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Id;
use App\Domain\User\ValueObject\Nickname;
use App\Domain\User\ValueObject\Password;

class User
{
    public function __construct(
        public readonly Id       $id,
        public readonly Email    $email,
        public readonly Password $password,
        public readonly Nickname $nickname,

    )
    {
    }
}