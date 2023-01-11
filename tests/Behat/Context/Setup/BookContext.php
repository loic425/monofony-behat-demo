<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context\Setup;

use App\Entity\Book;
use Behat\Behat\Context\Context;
use Doctrine\ORM\EntityManagerInterface;

final class BookContext implements Context
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @Given there is (also) a book with name :name
     */
    public function thereIsABookWithName(string $name): void
    {
        $book = new Book();
        $book->setName($name);

        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }
}
