Feature: As a website user I want to see the text

	@mink:selenium2
	Scenario: I check website availability
	Given I am on homepage
	Then I should see "Yahoo"

