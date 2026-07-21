<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class PanierController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/panier', name: 'app_panier')]
    public function index(SessionInterface $session, ArticlesRepository $articles, ): Response
    {
        $panierSession= $session->get('panier',[]);
        $panier=[];
        $total=0;

        foreach ($panierSession as $id=> $item){
            $article=$articles->find($id);
            if($article){
                $sousTotal= $article->getPrix() * $item['qte'];
                $panier[]=[
                    'article' => $article,
                    'qte' => $item['qte'],
                    'sousTotal'=>$sousTotal,
                ];
            $total += $sousTotal;
            }
        }


        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
            'total' => $total
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/panier/ajout/{id}', name: 'app_panier_ajout')]
    public function ajoutPanier(Int $id, Request $request, ArticlesRepository $articles, SessionInterface $session): Response
    {
        $article= $articles->find($id);

        if (!$article){
            return $this->redirectToRoute('app_home');
        }

        $qte = $request->request->get('qte',1);
        $panier= $session->get('panier',[]);

        $panier[$id]=[
            'qte' =>  (int) $qte,
        ];

        $session->set('panier', $panier);
    
        return $this->redirectToRoute('app_panier');
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/panier/vider', name: 'app_panier_vider')]
    public function viderPanier(  SessionInterface $session): Response
    {
        $session->remove('panier');    
        return $this->redirectToRoute('app_panier');
    }
}
