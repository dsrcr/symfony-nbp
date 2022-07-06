<?php

namespace App\Controller;

use App\Entity\Currency;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

class CurrencyController extends AbstractController
{
    #[Route('/currency', name: 'app_currency')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CurrencyController.php',
        ]);
    }

    #[Route('/addnewcurrency', name: 'app_currency')]
    public function addNewCurrency(ManagerRegistry $doctrine): Response
    {

        $entityManager = $doctrine->getManager();

        $product = new Currency();
        $product->setName('bat (Tajlandia)');
        $product->setCurrencyCode('THB');
        $product->setExchangeRate(0.1298);
        $entityManager->persist($product);
        $entityManager->flush();

        return new Response('Saved new currency with id ' . $product->getId());
    }


}
