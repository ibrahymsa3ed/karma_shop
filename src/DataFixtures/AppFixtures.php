<?php

namespace App\DataFixtures;

use App\Entity\Orders;
use App\Entity\OrdersProducts;
use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {


    }
}
