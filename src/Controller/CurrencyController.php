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
    public function addNewCurrency(HttpClientInterface $httpClient): array
    {
        $response = $httpClient->request('GET', 'http://api.nbp.pl/api/exchangerates/tables/A?format=json');
        $data = $response->toArray();
        dd($data[0]['rates']);
    }
}
