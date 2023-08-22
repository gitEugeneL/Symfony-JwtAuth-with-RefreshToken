<?php

namespace App\Service;

use App\Dto\User\CreateUserDto;
use App\Entity\User;
use App\Exception\ApiException;
use App\Repository\UserRepository;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly ApiException $apiException
    ) {}

    public function create(CreateUserDto $dto): array
    {
        if (!is_null($this->userRepository->findOneBy(['email' => $dto->getEmail()])))
            $this->apiException->exception("User already exist", 422);

        $user = (new User())
            ->setEmail($dto->getEmail())
            ->setPassword(password_hash($dto->getPassword(), PASSWORD_DEFAULT))
            ->setRoles(['ROLE_USER']);

        $this->userRepository->save($user, true);
        return ['userId' => $user->getId()];
    }

    public function delete(User $authUser): void
    {
        $user = $this->userRepository->find($authUser);
        if (is_null($user) || $user->getId() !== $authUser->getId())
            $this->apiException->exception("User doesn't exist", 422);

        $this->userRepository->remove($user, true);
    }
}