<?php

namespace App\Exception;

use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiException
{
    #[NoReturn]
    public function exception(string $message, int $code): void
    {
        $response = new JsonResponse(["detail" => $message], $code);
        $response->send();
        exit();
    }
}