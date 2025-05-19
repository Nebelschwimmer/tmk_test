<?php

declare(strict_types=1);

namespace App\Presentation\Http\App\Controller\Frontpage;

use App\Application\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class FrontpageController extends AbstractController
{
    public function __construct(
        private ArticleService $articleService,
    ) {
    }
    #[Route(path: '/', name: 'app_frontpage')]
    public function list(): Response
    {
        $articles = $this->articleService->list();

        return $this->render(
            'app/page/frontpage/page.html.twig',
            ['articles' => $articles]
        );
    }
    #[Route(path: '/{slug}', name: 'app_article')]
    public function detail(string $slug): Response
    {
        $article = $this->articleService->get($slug);

        return $this->render(
            'app/page/detailpage/article/detail.html.twig',
            ['article' => $article]
        );
    }
}
