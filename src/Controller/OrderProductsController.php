<?php

namespace App\Controller;


use App\Entity\Orders;
use App\Entity\OrdersProducts;
use App\Entity\Prices;
use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderProductsController extends AbstractController
{
    #[Route('/order_products', name: 'app_order_products')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $products = new Products();
        $products->setTitle('test');
        $products->setDescription('test');
        $products->setSpecs('test');

        $entityManager->persist($products);

        //add order
        $order = new Orders();
        $order->setDate(date_create());
        $order->setInvoiceNum('test');
        $order->setTotal(123);
        $entityManager->persist($order);

        //add price
        $price = new Prices();
        $price->setPrice(123);

        $price->setProduct($products);
        $price->setReason('test');
        $entityManager->persist($price);

        //create join
        $productOrderProducts = new OrdersProducts();
        $productOrderProducts->setPrice($price);
        $productOrderProducts->setProductQty(12);
        $productOrderProducts->setProducts($products);
        $productOrderProducts->setOrders($order);
        $entityManager->persist($productOrderProducts);



        $entityManager->flush();

        return new Response("productOrderProducts {$productOrderProducts->getId()}
         created for product{$products->getId()}
         and order {$order->getId()}");


//        return $this->render('order_products/index.html.twig', [
//            'controller_name' => 'OrderProductsController',
//            'website_title' => 'Karma cart',
//
//        ]);
    }
}
