<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProductRepository;

class HomeController extends AbstractController
{

    //    Private $entityManager;
    // /**
     // * ProductController constructer
     // * @param EntityManagerInterface  $entityManager
     //*/
    //public function __construct(EntityManagerInterface  $entityManager){
    //    $this->entityManager = $entityManager;
    //}
    
        #[Route('/', name: 'app_home')]
        public function index(ProductRepository $productRepository): Response
        {  
            return $this->render('home/home.html.twig',[ 
                'product' => $productRepository->findAll(),
        ]);
        }
    }