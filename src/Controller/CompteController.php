<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CommandesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class CompteController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/compte', name: 'app_compte')]
    public function index(CommandesRepository $commandesRepo, Security $security): Response
    {
        $user= $security->getUser();
        $commandes= $commandesRepo->findByUser($user);
        

        return $this->render('compte/index.html.twig', [
            'commandes' => $commandes,
        ]);

    }

    #[IsGranted('ROLE_USER')]
    #[Route('/compte/suppression', name: 'app_compte_suppression',methods: ['POST'])]
    public function suppression(EntityManagerInterface $em,Security $security, TokenStorageInterface $tokenStorage, Request $request): Response
    {
        $user = $security->getUser();
        
        if (!$user instanceof User) {
        throw $this->createAccessDeniedException();
        }

        $em->remove($user);
        $em->flush();

        $tokenStorage->setToken(null);
        $request->getSession()->invalidate();


    return $this->redirectToRoute('app_home');

    }
    
}
