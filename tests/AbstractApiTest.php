<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser as KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractApiTest extends WebTestCase
{
    protected KernelBrowser $client;

    protected array $testUser = [
        'username' => 'test@email.com',
        'password' => '00000000'
    ];

    protected string $accessToken;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    protected function post(string $uri, array $data = [], $accessToken = null): Response
    {
        $headers = [
            'HTTP_ACCEPT' => 'application/json',
            'HTTP_TYPE' => 'application/json',
            'CONTENT_TYPE' => 'application/json',
        ];
        if ($accessToken) {
            $headers['HTTP_AUTHORIZATION'] = 'Bearer ' . $accessToken;
        }

        $this->client->request(
            method: 'POST',
            uri: $uri,
            server: $headers,
            content: json_encode($data)
        );
        return $this->client->getResponse();
    }
}