<?php

namespace App\Tests;

class AuthApiTest extends AbstractApiTest
{
    public function testCreateUser(): void
    {
        $response = $this->post(
            uri: 'api/user/create',
            data: [
                'email' => AuthData::getUser()['username'],
                'password' => AuthData::getUser()['password']
            ]
        );
        $this->assertSame(201, $response->getStatusCode());
    }

    /**
     * @depends testCreateUser
     */
    public function testLogin(): void
    {
        $response = $this->post(
            uri: '/api/login',
            data: [
                'username' => AuthData::getUser()['username'],
                'password' => AuthData::getUser()['password']
            ]
        );
        AuthData::setAccessToken(json_decode($response->getContent(), true)['token']);
        AuthData::setRefreshToken($response->headers->getCookies()[0]->getValue());

        $this->assertSame(200, $response->getStatusCode());
    }

    /**
     * @depends testLogin
     */
    public function testRefreshToken(): void
    {
        $response = $this->post(
            uri: '/api/refresh',
            refreshToken: AuthData::getRefreshToken()
        );
        AuthData::setRefreshToken($response->headers->getCookies()[0]->getValue());

        $this->assertSame(200, $response->getStatusCode());
    }

    /**
     * @depends testRefreshToken
     */
    public function testDeleteUser(): void
    {
        $response = $this->delete(
            uri: '/api/user/delete',
            accessToken: AuthData::getAccessToken()
        );
        $this->assertSame(201, $response->getStatusCode());
    }

    /**
     * @depends testDeleteUser
     */
    public function testInvalidateRefreshToken(): void
    {
        $response = $this->post(
            uri: '/api/invalidate',
            refreshToken: AuthData::getRefreshToken()
        );
        $this->assertSame(200, $response->getStatusCode());
    }
}