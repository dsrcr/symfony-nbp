<?php

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CurrencyService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getCurrencyFromNbp(): array
    {
        $response = $this->client->request('GET', 'http://api.nbp.pl/api/exchangerates/tables/A?format=json');
        // $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->getContent();
        $content = $response->toArray();

        return $content;
    }
}