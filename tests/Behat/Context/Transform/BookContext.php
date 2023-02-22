<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context\Transform;

use App\Entity\Book;
use Behat\Behat\Context\Context;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Webmozart\Assert\Assert;

final class BookContext implements Context
{
    public function __construct(private RepositoryInterface $bookRepository)
    {
    }

    /**
     * @Transform :book
     */
    public function getBookByName(string $name): Book
    {
        /** @var Book|null $book */
        $book = $this->bookRepository->findOneBy(['name' => $name]);
        Assert::notNull($book);

        return $book;
    }
}
