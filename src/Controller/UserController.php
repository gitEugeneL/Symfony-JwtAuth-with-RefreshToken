<?php

namespace App\Controller;

use App\Dto\User\CreateUserDto;
use App\Service\UserService;
use App\Validator\RequestValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/user')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly UserService $userService,
        private readonly SerializerInterface $serializer,
        private readonly RequestValidator $requestValidator
    ) {}

    #[Route('/create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $dto = $this->serializer->deserialize($request->getContent(), CreateUserDto::class, 'json');
        $errors = $this->requestValidator->dtoValidator($dto);
        if (count($errors) > 0)
            return $this->json($errors, 422);

        $result = $this->userService->create($dto);
        return $this->json($result, 201);
    }
}