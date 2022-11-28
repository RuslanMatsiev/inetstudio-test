<?php

interface SecretKeyInterface
{
    public function getSecretKey(): string;
}

class SecretKeyInFile implements SecretKeyInterface
{
    public function getSecretKey(): string
    {
        return 'Key in file';
    }
}

class SecretKeyInDB implements SecretKeyInterface
{
    public function getSecretKey(): string
    {
        return 'Key in DB';
    }
}

class SecretKeyInRedis implements SecretKeyInterface
{
    public function getSecretKey(): string
    {
        return 'Key in Redis';
    }
}


class SecretKeyInCloud implements SecretKeyInterface
{
    public function getSecretKey(): string
    {
        return 'Key in cloud';
    }
}


class Concept
{
    private $secretKey;
    private $client;

    public function __construct(SecretKeyInterface $secretKey, \GuzzleHttp\Client $client)
    {
        $this->secretKey = $secretKey;
        $this->client = $client;
    }

    public function getUserData()
    {
        $params = [
            'auth' => ['user', 'pass'],
            'token' => $this->secretKey->getSecretKey()
        ];

        $request = new \Request('GET', 'https://api.method', $params);
        $promise = $this->client->sendAsync($request)->then(function ($response) {
            $result = $response->getBody();
        });

        $promise->wait();
    }
}