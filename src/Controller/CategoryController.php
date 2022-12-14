<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Products;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class CategoryController extends AbstractController
{
    private $em;
    // private $xeRepository;
    private Security $security;
    private CategoriesRepository $categoriesRepository;

    public function __construct( CategoriesRepository $categoriesRepository, EntityManagerInterface $em)
    {
        $this->em = $em;
        //$this->xeRepository = $xeRepository;
        $this->categoriesRepository = $categoriesRepository;
    }

    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        $repository = $this->em->getRepository(Categories::class);
        $all_categories = $repository->findAll();//findBy(['user' => $this->security->getUser()->getEmail()]);

        return $this->render('category/category.html.twig', [
            'controller_name' => 'CategoryController',
            'website_title' => 'Karma category',
            'all_categories' => $all_categories,
        ]);
    }
}
