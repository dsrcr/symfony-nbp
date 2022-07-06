<?php

namespace App\Controller;

use App\Entity\Currency;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use CurrencyService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CurrencyController extends AbstractController
{
    #[Route('/addnewcurrency', name: 'app_currency')]
    public function addNewCurrency(HttpClientInterface $httpClient, ManagerRegistry $doctrine): Response
    {
        $response = $httpClient->request('GET', 'http://api.nbp.pl/api/exchangerates/tables/A?format=json');
        $data = $response->toArray();
        $currencies = $data[0]['rates'];
        $currency = $currencies[1];

        $name = strval($currency['currency']);
        $currency_code = strval($currency['code']);
        $exchange_rate = strval($currency['mid']);

        $entityManager = $doctrine->getManager();
            $currency = new Currency();
            $currency->setName($name);
            $currency->setCurrencyCode($currency_code);
            $currency->setExchangeRate($exchange_rate);
            $entityManager->persist($currency);
            $entityManager->flush();
        return new Response('The currencies has been added'); 
    }
}
