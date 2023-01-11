<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context\Ui\Backend;

use App\Tests\Behat\Page\Backend\Book\IndexPage;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Webmozart\Assert\Assert;

final class ManagingBooksContext implements Context
{
    public function __construct(
        private IndexPage $indexPage,
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
}
