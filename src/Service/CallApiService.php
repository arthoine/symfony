<?php

namespace App\Service;

use DateTime;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getClients(): array
    {
        return $this->getApi('clients');
    }

    public function getAllData(): array
    {
        return $this->getApi('');
    }



    public function getApi(string $var)
    {
        $response = $this->client->request(
            'GET',
            'http://symfony.localhost/api/' . $var
        );

        return $response->toArray();
    }
}
