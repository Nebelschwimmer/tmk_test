<?php

declare(strict_types=1);

namespace App\Domain\RepositoryFilter\Article;


class ArticleFilter
{
    /**
     * @param string $title
     * @param string $slug
     */
    public function __construct(
        public ?string $title = null,
        public ?string $slug = null,
    ) {
    }
}
