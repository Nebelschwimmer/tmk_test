<?php

namespace App\Application\Service;

use App\Application\Dto\Request\ArticleDto;
use App\Application\Dto\Request\ArticleResponse;
use App\Application\Mapper\Entity\ArticleMapper;
use App\Domain\Entity\Article\Article;
use App\Infrastructure\Persistence\Doctrine\Repository\Article\ArticleRepository;
class ArticleService
{
    public function __construct(
        private ArticleRepository $repository,
        private ArticleMapper $mapper,
    ) {
    }

    public function get(string $slug): ?ArticleResponse
    {
        $article = $this->findBySlug($slug);
        return $this->mapper->toResponse($article);
    }

    public function list(): array
    {
        $articles = $this->repository->findAll();
        return $this->mapper->mapList($articles);
    }

    public function create(ArticleDto $dto): ArticleResponse
    {
        $article = new Article($dto->title, $dto->description);

        $this->repository->save($article);

        return $this->mapper->toResponse($article);
    }

    public function update(string $slug, ArticleDto $dto): ArticleResponse
    {
        $article = $this->findBySlug($slug)
            ->edit($dto->title, $dto->description);
        $this->repository->save($article);

        return $this->mapper->toResponse($article);
    }

    public function delete(string $slug, Article $article): void
    {
        $article = $this->findBySlug($slug);
        $this->repository->delete($article);
    }

    private function findBySlug(string $slug): Article
    {
        $article = $this->repository->findBy(['slug' => $slug])[0] ?? null;
        return $article;
    }

}