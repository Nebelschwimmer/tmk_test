<?php

namespace App\Application\EventListener;

use App\Domain\Entity\Article\Article;
use Symfony\Component\String\Slugger\SluggerInterface;

class ArticleEventListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Article $article): void
    {
        $article->setSlug($this->generateSlug($article));
    }

    public function preUpdate(Article $article): void
    {
        $article->setSlug($this->generateSlug($article));
    }

    public function generateSlug(Article $article): string
    {
        $slug = $this->slugger->slug($article->getTitle())->lower() . uniqid("_");
        return $slug;
    }
}
