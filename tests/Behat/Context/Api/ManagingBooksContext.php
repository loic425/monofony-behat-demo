<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context\Api;

use App\Entity\Book;
use App\Tests\Behat\Client\ApiClientInterface;
use App\Tests\Behat\Client\ResponseCheckerInterface;
use Behat\Behat\Context\Context;
use Webmozart\Assert\Assert;

final class ManagingBooksContext implements Context
{
    public function __construct(
        private ApiClientInterface $client,
        private ResponseCheckerInterface $responseChecker,
    ) {
    }

    /**
     * @When I want to browse books
     * @Given I am browsing books
     */
    public function iWantToBrowseBooks(): void
    {
        $this->client->index(Resources::BOOKS);
    }

    /**
     * @Given I want to create a new book
     */
    public function iWantToCreateANewBook()
    {
        $this->client->buildCreateRequest(Resources::BOOKS);
    }

    /**
     * @When /^I want to edit (this book)$/
     */
    public function iWantToEditThisBook(Book $book): void
    {
        $this->client->buildUpdateRequest(Resources::BOOKS, (string) $book->getId());
    }

    /**
     * @When I specify its name as :name
     * @When I change its name to :name
     * @When I do not specify any name
     */
    public function iSpecifyItsNameAs(?string $name = null): void
    {
        if (null !== $name) {
            $this->client->addRequestData('name', $name);
        }
    }

    /**
     * @When I (try to) add it
     */
    public function iAddIt(): void
    {
        $this->client->create();
    }

    /**
     * @When I save my changes
     */
    public function iSaveMyChanges(): void
    {
        $this->client->update();
    }

    /**
     * @When I delete book with name :book
     */
    public function iDeleteBookWithName(Book $book): void
    {
        $this->client->delete(Resources::BOOKS, (string) $book->getId());
    }

    /**
     * @Then there should be :amount books in the list
     */
    public function thereShouldBeBooksInTheList(int $amount): void
    {
        Assert::same($this->responseChecker->countCollectionItems($this->client->getLastResponse()), $amount);
    }

    /**
     * @Then I should see the book :name in the list
     * @Then the book :name should appear in the list
     * @Then this book with name :name should appear in the list
     */
    public function iShouldSeeTheBookInTheList(string $name): void
    {
        Assert::true(
            $this->responseChecker->hasItemWithValue($this->client->index(Resources::BOOKS), 'name', $name),
            sprintf('Book with name %s does not exist', $name),
        );
    }

    /**
     * @Then there should not be :name book anymore
     */
    public function thereShouldNotBeBookAnymore(string $name): void
    {
        Assert::false(
            $this->responseChecker->hasItemWithValue($this->client->index(Resources::BOOKS), 'name', $name),
            sprintf('Book with name %s exists, but it should not', $name),
        );
    }

    /**
     * @Then I should be notified that it has been successfully created
     */
    public function iShouldBeNotifiedThatItHasBeenSuccessfullyCreated(): void
    {
        Assert::true(
            $this->responseChecker->isCreationSuccessful($this->client->getLastResponse()),
            'Book could not be created',
        );
    }

    /**
     * @Then I should be notified that it has been successfully edited
     */
    public function iShouldBeNotifiedThatItHasBeenSuccessfullyEdited(): void
    {
        Assert::true(
            $this->responseChecker->isUpdateSuccessful($this->client->getLastResponse()),
            'Book could not be edited',
        );
    }

    /**
     * @Then I should be notified that it has been successfully deleted
     */
    public function iShouldBeNotifiedThatItHasBeenSuccessfullyDeleted(): void
    {
        Assert::true(
            $this->responseChecker->isDeletionSuccessful($this->client->getLastResponse()),
            'Book could not be deleted',
        );
    }

    /**
     * @Then I should be notified that :element is required
     */
    public function iShouldBeNotifiedThatNameIsRequired(string $element): void
    {
        Assert::contains(
            $this->responseChecker->getError($this->client->getLastResponse()),
            sprintf('%s: This value should not be blank.', $element),
        );
    }

}
