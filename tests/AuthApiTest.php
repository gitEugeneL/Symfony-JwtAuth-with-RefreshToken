<?php

namespace App\Tests;


class AuthApiTest extends AbstractApiTest
{
    public function testCreate(): void
    {
        $response = $this->post('api/user/create', [
            'email' => $this->testUser['username'],
            'password' => $this->testUser['password']
        ]);
        $this->assertSame(201, $response->getStatusCode());
    }

    /**
     * @depends testCreate
     */
    public function testLogin(): void
    {
        $response = $this->post('/api/login', [
            'username' => $this->testUser['username'],
            'password' => $this->testUser['password']
        ]);
        $this->accessToken = json_decode($response->getContent(), true)['token'];
        $this->assertSame(200, $response->getStatusCode());
    }

}