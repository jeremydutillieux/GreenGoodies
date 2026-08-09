<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

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

    #[Route('/api/articles', name: 'api_article', methods: ['GET'])]
    public function getArticleList(ArticlesRepository $repository, SerializerInterface $serializer): JsonResponse
    {
        $articles= $repository->findAll();
        $jsonArticlesList= $serializer->serialize($articles, 'json', ['groups' => 'article:read']);

        return new JsonResponse($jsonArticlesList, Response::HTTP_OK,[],true);
    }

    #[Route('/api/articles/{id}', name: 'api_details_article', methods: ['GET'])]
    public function getArticleId(?Articles $article, SerializerInterface $serializer): JsonResponse
    {
       # $article= $repository->find($id);;
       # $jsonArticle= $serializer->serialize($article, 'json', ['groups' => 'article:read']);

       # if (!$article)
        #{
       #   return new JsonResponse(null, Response::HTTP_NOT_FOUND);  
        #}

       # return new JsonResponse($jsonArticle, Response::HTTP_OK,[],true);
    if (!$article) {
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    $jsonArticle = $serializer->serialize($article, 'json', ['groups' => 'article:read']);

    return new JsonResponse($jsonArticle, Response::HTTP_OK, [], true);
    }
}
