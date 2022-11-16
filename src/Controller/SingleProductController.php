<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SingleProductController extends AbstractController
{
    #[Route('/product', name: 'app_single_product')]
    public function index(): Response
    {
        return $this->render('single_product/single_product.html.twig', [
            'controller_name' => 'SingleProductController',
            'website_title' => 'Karma product',
        ]);
    }
}
