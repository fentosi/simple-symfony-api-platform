<?php


namespace App\Tests\functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class AuthTest extends WebTestCase
{
    public function testApiIsInaccessibleWithoutCredentials() {
        $client = static::createClient();

        $client->request('GET', '/api/');

        $this->assertFalse($client->getResponse()->isSuccessful());
    }

    public function testApiIsInaccessibleWithWrongCredentials() {
        $client = static::createClient();

        $client->request('GET', '/api/', [], [], [
            'PHP_AUTH_USER' => 'test',
            'PHP_AUTH_PW'   => 'incorrect_pw',
        ]);

        $this->assertFalse($client->getResponse()->isSuccessful());
    }

    public function testApiIsAccessibleWithWrongCredentials() {
        $client = static::createClient();

        $client->request('GET', 'api/', [], [], [
            'PHP_AUTH_USER' => 'test',
            'PHP_AUTH_PW'   => 'test'
        ]);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}