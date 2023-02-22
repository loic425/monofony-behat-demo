@managing_books
Feature: Editing a book
    In order to change information about a book
    As an Administrator
    I want to be able to edit a book

    Background:
        Given there is a book with name "Shinning"
        And I am logged in as an administrator

    @ui @api
    Scenario: Renaming a book
        When I want to edit this book
        And I change its name to "Carrie"
        And I save my changes
        Then I should be notified that it has been successfully edited
        And this book with name "Carrie" should appear in the list
