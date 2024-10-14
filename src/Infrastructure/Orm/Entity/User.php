<?php

namespace App\Infrastructure\Orm\Entity;

use App\Infrastructure\Orm\Repository\UserRepository;
use Doctrine\ORM\Mapping as Orm;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[Orm\Entity(repositoryClass: UserRepository::class)]
#[Orm\Table(name: '`User`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    public function __construct(string $email, string $password, string $nickname, UserPasswordHasherInterface $passwordHasher)
    {
        $this->setEmail($email);
        $this->setNickname($nickname);

        $hashedPassword = $passwordHasher->hashPassword(
            $this,
            $password
        );
        $this->setPassword($hashedPassword);
    }

    #[Orm\Id]
    #[Orm\GeneratedValue]
    #[Orm\Column(type: 'integer')]
    private int $id;

    #[Orm\Column(type: 'string', length: 180, unique: true)]
    private ?string $email;

    #[Orm\Column(type: 'json')]
    private array $roles = [];

    #[Orm\Column(type: 'string')]
    private string $password;

    #[Orm\Column(type: 'string', length: 180, unique: true)]
    private $nickname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * The public representation of the user (e.g. a username, an email address, etc.)
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->nickname;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

}
