@managing_books
Feature: Deleting a book
    In order to get rid of deprecated books
    As an Administrator
    I want to be able to delete a book

    Background:
        Given there is a book with name "Shinning"
        And there is also a book with name "Carrie"
        And I am logged in as an administrator

    @ui
    Scenario: Deleting a book
        Given I am browsing books
        When I delete book with name "Shinning"
        Then I should be notified that it has been successfully deleted
        And there should not be "Shinning" book anymore
