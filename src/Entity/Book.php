<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Annotation\SyliusCrudRoutes;
use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[SyliusCrudRoutes(
    alias: 'app.book',
    path: 'admin/books',
    section: 'backend',
    templates: 'backend/crud',
    grid: 'app_book',
    except: ['show'],
)]
#[ApiResource(
    normalizationContext: ['groups' => 'book:read']
)]
#[Get]
#[GetCollection]
#[Post]
#[Put]
#[Patch]
#[Delete]
class Book implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[NotBlank]
    #[Groups(['book:read'])]
    private ?string $name = null;

    #[ORM\Column(type: 'string')]
    #[NotBlank]
    private ?string $slug = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }
}
