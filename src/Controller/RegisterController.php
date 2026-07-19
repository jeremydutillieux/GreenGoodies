<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $userPassword,Security $security): Response
    {
        
        $user= new User();
        $form= $this->createForm(RegisterType::class , $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $password = $form->get('plainPassword')->getData();
            $user ->setPassword($userPassword->hashPassword($user, $password));
            $manager->persist($user);
            $manager->flush();

            $security->login($user, 'form_login', 'main');

            return $this->redirectToRoute('app_home');
        }
    
    
        return $this->render('register/index.html.twig', [
            'registerForm' => $form ,
        ]);
    }
}
