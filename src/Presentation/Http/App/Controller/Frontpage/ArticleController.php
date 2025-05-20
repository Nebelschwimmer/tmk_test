<?php

declare(strict_types=1);

namespace App\Presentation\Http\App\Controller\Frontpage;

use App\Application\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route(path: '/article')]
class ArticleController extends AbstractController
{
    public function __construct(
        private ArticleService $articleService,
    ) {
    }
    #[Route(path: '/{slug}', name: 'article_detail')]
    public function detail(string $slug): Response
    {
        $article = $this->articleService->get($slug);

        return $this->render(
            'app/page/detailpage/article/detail.html.twig',
            ['article' => $article]
        );
    }
}
