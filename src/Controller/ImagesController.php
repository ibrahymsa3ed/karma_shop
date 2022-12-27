<?php


namespace App\Controller;

use App\Entity\Images;
use App\Entity\Products;
use App\Form\ImagesType;
use App\Repository\ImagesRepository;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Query\ResultSetMapping;

class ImagesController extends AbstractController
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


    #[Route('/add_images', name: 'add_images')]
    public function add(Request $request): Response
    {
        $image = new Images();
        $all_products = $this->productsRepository->findAll();

      // $products = $this->productsRepository->findOneBy(['title' => 'myProduct']);


        if (isset($_POST['submit_btn'])) {
            $product_id=$_POST['product_id'];
            $products = $this->productsRepository->findOneBy(['id' =>$product_id]);
            $tmp_name=$_FILES["imagePath"]["tmp_name"];
            $name=$_FILES["imagePath"]["name"];

            $this->add_image($products, $tmp_name, $name);



            return $this->redirectToRoute('add_images');








        } else {
            return $this->render('images/add_image.html.twig', [
                'controller_name' => 'AddOrderController',
                'website_title' => 'Karma login',
                'all_products' => $all_products
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
}
