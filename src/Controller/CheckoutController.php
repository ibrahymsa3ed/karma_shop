<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    #[Route('/checkout', name: 'app_checkout')]
    public function index(): Response
    {
        return $this->render('checkout/checkout.html.twig', [
            'controller_name' => 'CheckoutController',
            'website_title' => 'Karma checkout',
        ]);
    }
}
