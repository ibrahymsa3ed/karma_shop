<?php

namespace App\DataFixtures;

use App\Entity\Orders;
use App\Entity\OrdersProducts;
use App\Entity\Products;
use App\Entity\Prices;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderProductsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //add product
        $products = new Products();
        $products->setTitle('test');
        $products->setDescription('test');
        $products->setSpecs('test');

        $manager->persist($products);

        //add order
        $order = new Orders();
        $order->setDate(date_create());
        $order->setInvoiceNum('test');
        $order->setTotal(123);
        $manager->persist($order);

        //add price
        $price = new Prices();
        $price->setPrice(123);

        $price->setProduct($products);
        $price->setReason('test');
        $manager->persist($price);

        //create join
        $productOrderProducts = new OrdersProducts();
        $productOrderProducts->setPrice($price);
        $productOrderProducts->setProductQty(12);
        $productOrderProducts->setProducts($products);
        $productOrderProducts->setOrders($order);
        $manager->persist($productOrderProducts);

        $manager->flush();
    }
}
