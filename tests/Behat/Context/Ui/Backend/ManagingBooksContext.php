<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context\Ui\Backend;

use App\Entity\Book;
use App\Tests\Behat\Page\Backend\Book\CreatePage;
use App\Tests\Behat\Page\Backend\Book\IndexPage;
use App\Tests\Behat\Page\Backend\Book\UpdatePage;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Webmozart\Assert\Assert;

final class ManagingBooksContext implements Context
{
    public function __construct(
        private IndexPage $indexPage,
        private CreatePage $createPage,
        private UpdatePage $updatePage,
    ) {
    }

    /**
     * @When I want to browse books
     * @Given I am browsing books
     */
    public function iWantToBrowseBooks(): void
    {
        $this->indexPage->open();
    }

    /**
     * @Given I want to create a new book
     */
    public function iWantToCreateANewBook(): void
    {
        $this->createPage->open();
    }

    /**
     * @When /^I want to edit (this book)$/
     */
    public function iWantToEditThisBook(Book $book): void
    {
        $this->updatePage->open(['id' => $book->getId()]);
    }

    /**
     * @When I specify its name as :name
     */
    public function iSpecifyItsNameAs(string $name): void
    {
        $this->createPage->nameIt($name);
    }

    /**
     * @When I change its name to :name
     */
    public function iChangeItsNameTo(string $name): void
    {
        $this->updatePage->nameIt($name);
    }

    /**
     * @When I add it
     */
    public function iAddIt(): void
    {
        $this->createPage->create();
    }

    /**
     * @When I save my changes
     */
    public function iSaveMyChanges(): void
    {
        $this->updatePage->saveChanges();
    }

    /**
     * @When I delete book with name :name
     */
    public function iDeleteBookWithName(string $name): void
    {
        $this->indexPage->deleteResourceOnPage(['name' => $name]);
    }

    /**
     * @Then there should be :amount books in the list
     */
    public function thereShouldBeBooksInTheList(int $amount): void
    {
        Assert::eq($this->indexPage->countItems(), $amount);
    }

    /**
     * @Then I should see the book :name in the list
     */
    public function iShouldSeeTheBookInTheList(string $name): void
    {
        Assert::true($this->indexPage->isSingleResourceOnPage(['name' => $name]));
    }

    /**
     * @Then the book :name should appear in the list
     * @Then this book with name :name should appear in the list
     */
    public function theBookShouldAppearInTheList(string $name): void
    {
        $this->indexPage->open();

        Assert::true($this->indexPage->isSingleResourceOnPage(['name' => $name]));
    }

    /**
     * @Then there should not be :name book anymore
     */
    public function thereShouldNotBeBookAnymore(string $name): void
    {
        $this->indexPage->open();

        Assert::false($this->indexPage->isSingleResourceOnPage(['name' => $name]));
    }
}
