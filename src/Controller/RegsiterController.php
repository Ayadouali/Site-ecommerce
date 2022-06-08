<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegsiterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class RegsiterController extends AbstractController
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager =$entityManager;
    }


    #[Route('/register', name: 'app_regsiter')]



    public function index(Request $req, UserPasswordHasherInterface $hasher): Response
    {

        $user = new User();
        $form = $this -> createForm(RegsiterType::class, $user);
        
        $form -> handleRequest($req);

        if( $form -> isSubmitted() && $form ->isValid()) {

            $user =  $form -> getData();
            $user ->setRoles(array('ROLE_USER'));
            //dd($user);
            $password =$user->getPassword();
            $hashedPassword =$hasher->hashPassword($user,$password);
            $user->setPassword($hashedPassword);
        

          
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
        return $this->render('regsiter/index.html.twig', [
            'form' => $form -> createView(),
        ]);
    }
}
