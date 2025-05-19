<?php

declare(strict_types=1);

namespace App\Domain\Repository\Article;

use App\Domain\Entity\Article\Article;

interface ArticleRepositoryInterface
{
        /**
     * Сохранить статью
     *
     * @param Article $acrticle
     *
     * @return void
     */
    public function store(Article $acrticle): void;

    /**
     * Удалить статью
     *
     * @param Article $acrticle
     *
     * @return void
     */
    public function delete(Article $acrticle): void;
}
