<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArticleController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function listeArticles(ArticlesRepository $repository): Response
    {
        $articles= $repository->findAll();
    
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/article/{id}', name: 'app_article')]
    public function detailArticle(int $id,ArticlesRepository $repository): Response
    {
        $article= $repository->find($id);
    
        if (!$article){
            return $this->redirectToRoute('app_home');
        }
        
        return $this->render('article/article.html.twig', [
            'article' => $article,
        ]);
    }
}
