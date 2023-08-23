<?php

namespace App\Tests;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Bundle\FrameworkBundle\KernelBrowser as KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractApiTest extends WebTestCase
{
    private array $mainHeaders = [
        'HTTP_ACCEPT' => 'application/json',
        'HTTP_TYPE' => 'application/json',
        'CONTENT_TYPE' => 'application/json',
    ];

    protected KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    private function setAccessToken(string $accessToken): void
    {
        $this->mainHeaders['HTTP_AUTHORIZATION'] = 'Bearer ' . $accessToken;
    }


    protected function post(string $uri, array $data = [], string $accessToken = null, string $refreshToken = null): Response
    {
        if ($accessToken) {
            $this->setAccessToken($accessToken);
        }
        if($refreshToken) {
            $cookie = new Cookie('refreshToken', $refreshToken);
            $this->client->getCookieJar()->set($cookie);
        }

        $this->client->request(
            method: 'POST',
            uri: $uri,
            server: $this->mainHeaders,
            content: json_encode($data)
        );
        return $this->client->getResponse();
    }

    protected function delete(string $uri, array $data = [], string $accessToken = null): Response
    {
        if ($accessToken) {
            $this->setAccessToken($accessToken);
        }
        $this->client->request(
            method: 'DELETE',
            uri: $uri,
            server: $this->mainHeaders,
            content: json_encode($data)
        );
        return $this->client->getResponse();
    }
}