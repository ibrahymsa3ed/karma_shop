<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function cart(): Response
    {
        return $this->render('cart/cart.html.twig', [
            'controller_name' => 'MainController',
            'website_title' => 'Karma cart',
        ]);
    }
}
