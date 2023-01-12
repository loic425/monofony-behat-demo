@managing_books
Feature: Adding a new book
    In order to create new book
    As an Administrator
    I want to add a book in the admin panel

    Background:
        Given I am logged in as an administrator

    @ui
    Scenario: Adding a new book
        Given I want to create a new book
        When I specify its name as "Shinning"
        And I add it
        Then I should be notified that it has been successfully created
        And the book "Shinning" should appear in the list
