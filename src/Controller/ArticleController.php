<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArticleController extends AbstractController
{
    #[Route('/articles', name: ' article_list')]
    public function list(ArticlesRepository $articlesRepository): Response
    {
        $articles = $articlesRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('<public/article_list.html.twig', [
            'articles' => $articles,
        ]);
       
    }

    #[Route('/articles/{slug}', name: 'article_show')]
    public function show(Articles $articles): Response
    {
       
        return $this->render('public/article_show.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/admin/articles', name: 'admin_article_list')]
    public function adminlist(ArticlesRepository $articlesRepository): Response
    {
        $articles = $articlesRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('admin/articles.html.twig', [
            'articles' => $articles,
        ]);
    }
}
