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

class AddOrderController extends AbstractController
{
    #[Route('/add_order', name: 'app_add_order')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        if (isset($_POST['submit_btn'])) {
            //dd($_POST);
            $products = new Products();
            $products->setTitle($_POST['product_title']);
            $products->setDescription($_POST['product_desc']);
            $products->setSpecs($_POST['product_specs']);
            $entityManager->persist($products);

            //add order
            $order = new Orders();
            $input_date=$_POST['order_date'];
            $order_date=date_create($input_date);;
            $order->setDate($order_date);
            $order->setInvoiceNum($_POST['order_inv_num']);
            $order_total=floatval($_POST['product_price'])*floatval($_POST['product_qty']);
            $order->setTotal($order_total);
            $order->setProduct($products);
            $entityManager->persist($order);

            //add price
            $price = new Prices();
            $price->setPrice($_POST['product_price']);

            $price->setProduct($products);
            $price->setReason($_POST['price_reason']);
            $entityManager->persist($price);

            //create join
            $productOrderProducts = new OrdersProducts();
            $productOrderProducts->setPrice($price);
            $productOrderProducts->setProductQty($_POST['product_qty']);
            $productOrderProducts->setProducts($products);
            $productOrderProducts->setOrders($order);
            $entityManager->persist($productOrderProducts);


            $entityManager->flush();

            return new Response("productOrderProducts {$productOrderProducts->getId()}
         created for product{$products->getId()}
         and order {$order->getId()}");


        } else {
            return $this->render('add_order/index.html.twig', [
                'controller_name' => 'AddOrderController',
                'website_title' => 'Karma login'
            ]);
        }

    }
}
