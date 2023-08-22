<?php

namespace App\Tests;

class AuthData
{
    private static string $accessToken;
    private static string $refreshToken;

    private static array $user = [
        'username' => 'user@test.com',
        'password' => '12345678'
    ];

    public static function getUser(): array
    {
        return self::$user;
    }

    public static function setUser(array $user): void
    {
        self::$user = $user;
    }

    public static function getAccessToken(): string
    {
        return self::$accessToken;
    }

    public static function setAccessToken($accessToken): void
    {
        self::$accessToken = $accessToken;
    }

    public static function getRefreshToken(): string
    {
        return self::$refreshToken;
    }

    public static function setRefreshToken($refreshToken): void
    {
        self::$refreshToken = $refreshToken;
    }
}