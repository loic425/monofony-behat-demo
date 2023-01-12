<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context\Ui\Backend;

use App\Tests\Behat\Page\Backend\Book\CreatePage;
use App\Tests\Behat\Page\Backend\Book\IndexPage;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Webmozart\Assert\Assert;

final class ManagingBooksContext implements Context
{
    public function __construct(
        private IndexPage $indexPage,
        private CreatePage $createPage,
    ) {
    }

    /**
     * @When I want to browse books
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
     * @When I specify its name as :name
     */
    public function iSpecifyItsNameAs(string $name): void
    {
        $this->createPage->nameIt($name);
    }

    /**
     * @When I add it
     */
    public function iAddIt(): void
    {
        $this->createPage->create();
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
     */
    public function theBookShouldAppearInTheList(string $name): void
    {
        $this->indexPage->open();

        Assert::true($this->indexPage->isSingleResourceOnPage(['name' => $name]));
    }
}
