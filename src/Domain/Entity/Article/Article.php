<?php

namespace App\Domain\Entity\Article;


use App\Infrastructure\Persistence\Doctrine\Repository\Article\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\DBAL\Types\Types;
use App\Domain\Enum\Status;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    use TimestampableEntity;
    public const DEFAULT_STATUS = Status::DRAFT;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, unique:true)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::SMALLINT, enumType: Status::class)]
    private ?Status $status = self::DEFAULT_STATUS;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $views = null;

    public function __construct(
        string $title,
        string $description,
        ?Status $status = self::DEFAULT_STATUS,
        ?int $views = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->views = $views;
    }

    public function edit(
        string $title,
        string $description,
        ?Status $status = self::DEFAULT_STATUS,
        ?int $views = null
    ): self {
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->views = $views;

        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

}
