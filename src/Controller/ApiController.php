<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
class ApiController extends AbstractController
{
    private $serializer;
    public function __construct( CategoriesRepository $categoriesRepository, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->categoriesRepository = $categoriesRepository;
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        $repository = $this->em->getRepository(Categories::class);
        $all_categories = $repository->findAll();//findBy(['user' => $this->security->getUser()->getEmail()]);
        //dd($all_categories);

        $jsonContent = $this->serializer->serialize($all_categories, 'json');
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
            'website_title' => 'Karma category',
            'categories_json' => $jsonContent,
        ]);
    }
}
