@managing_books
Feature: Books validation
    In order to avoid making mistakes when managing a book
    As a Project manager
    I want to be prevented from adding or editing it without specifying required fields

    Background:
        Given I am logged in as an administrator

    @ui
    Scenario: Trying to add a new book without specifying its name
        When I want to create a new book
        And I do not specify any name
        And I try to add it
        Then I should be notified that name is required
