<?php
namespace App\Application\Mapper\Entity;

use App\Application\Dto\Request\ArticleResponse;
use App\Domain\Entity\Article\Article;
use App\Application\Dto\Request\ArticleDto;
use Symfony\Contracts\Translation\TranslatorInterface;

class ArticleMapper
{

    public function __construct(
        private TranslatorInterface $translator,
    ) {
    }

    public function toResponse(Article $article): ArticleResponse
    {
        return new ArticleResponse(
            $article->getId(),
            $article->getSlug(),
            $article->getTitle(),
            $article->getDescription(),
            $article->getStatus()->trans($this->translator),
            $this->formatViews($article->getViews()),
            $article->getCreatedAt()->format('d-m-Y H:i:s'),
        );
    }

    public function toEntity(ArticleDto $dto): Article
    {
        return new Article(
            $dto->title,
            $dto->description,
            $dto->status,
        );
    }

    public function mapList(array $articles): array
    {
        return array_map(function (Article $article) {
            return $this->toResponse($article);
        }, $articles);
    }

    private function formatViews(int $views): string
    {
        return match (true) {
            $views < 1000 => $views,
            $views < 1000000 => number_format($views / 1000, 1) . 'K',
            default => number_format($views / 1000000, 1) . 'M',
        };
    }

}