<?php
namespace App\Application\Dto\Request;

class ArticleDto {
    public function __construct(
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        public readonly ?string $status = null,
    ){}
}