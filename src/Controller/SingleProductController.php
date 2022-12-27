<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Products;
use App\Repository\ImagesRepository;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SingleProductController extends AbstractController
{
    private $image;
    private EntityManagerInterface $entityManager;
    private ImagesRepository $imagesRepository;
    private ProductsRepository $productsRepository;


    public function __construct(ProductsRepository $productsRepository, ImagesRepository $imagesRepository, EntityManagerInterface $entityManager)
    {
        $this->imagesRepository = $imagesRepository;
        $this->productsRepository = $productsRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/product', name: 'app_single_product')]
    public function index(): Response
    {
        return $this->render('single_product/single_product.html.twig', [
            'controller_name' => 'SingleProductController',
            'website_title' => 'Karma product',
        ]);
    }

    #[Route('/add_product', name: 'add_product')]
    public function add(EntityManagerInterface $entityManager): Response
    {

        if (isset($_POST['submit_btn'])) {

            $products = new Products();
            $products->setTitle($_POST['product_title']);
            $products->setDescription($_POST['product_desc']);
            $products->setSpecs($_POST['product_specs']);
            $entityManager->persist($products);
            $this->entityManager->flush();
            $images = $_FILES['images'];
            $counter = count($images['name']);

            for ($i = 0; $i < $counter; $i++) {
                $tmp_name = $images['tmp_name'][$i];
                $name = $images['name'][$i];
                $this->add_image($products, $tmp_name, $name);
            }

            return $this->redirectToRoute('add_product');

        } else {
            return $this->render('single_product/add_product.html.twig', [
                'controller_name' => 'SingleProductController',
                'website_title' => 'Karma product',
                'is_admin'=>False
            ]);
        }

    }

    private function add_image($product_object, $tmp_name, $name)
    {
        $product_name=$product_object->getTitle();
        $image = new Images();
        $image->setTitle($product_name."_image");
        $image->setProduct($product_object);
        $imagePath = $tmp_name;
        $new_path = $this->getParameter('kernel.project_dir') . "/public/uploads/" . basename($name);

        $imageFileType = strtolower(pathinfo($new_path, PATHINFO_EXTENSION));

        $newFileName = $product_name.'_'.uniqid() . '.' . $imageFileType;

        try {
            $upload_path= $this->getParameter('kernel.project_dir') . "/public/uploads/" .$newFileName;
            move_uploaded_file($tmp_name, $upload_path);
        } catch (FileException $e) {
            return new Response($e->getMessage());
        }

        // updates the 'brochureFilename' property to store the PDF file name
        // instead of its contents
        $image->setImagePath('/uploads/' . $newFileName);


        // ... persist the $product variable or any other work
        $this->entityManager->persist($image);
        $this->entityManager->flush();
    }
    #[Route('/products_delete/{id}', name: 'products_delete', methods: ['GET'])]
    public function delete($id): Response
    {

        $repository = $this->entityManager->getRepository(Products::class);
        $data = $repository->find($id);
        $this->entityManager->remove($data);
        $this->entityManager->flush();
        return $this->redirectToRoute('show_products');


    }

    #[Route('/show_products', name: 'show_products', methods: ['GET'])]
    public function show(): Response
    {
            $all_products = $this->productsRepository->findAll();

               return $this->render('single_product/show_products.html.twig', [
            'controller_name' => 'SingleProductController',
            'website_title' => 'Karma product',
                   'all_products'=>$all_products
        ]);
    }
}
