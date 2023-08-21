<?php

namespace App\Dto\User;

use Symfony\Component\Validator\Constraints as Assert;
class CreateUserDto
{
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Email]
    private string $email;

    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Length(min: 8)]
    private string $password;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}