<?php
namespace App\Application\Dto\Request;

class ArticleResponse {
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $slug = null,
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        public readonly ?string $status = null,
        public readonly ?string $views = null,
        public readonly ?string $createdAt = null,
    ){}
}