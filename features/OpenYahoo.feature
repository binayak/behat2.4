Feature: As a user 
    in order to find information 
    I want to do some search
	
	Scenario Outline: Search for an apple
		Given I am on the homepage
		And I search for <criteria>
		Then I should see <criteria>

		Examples:
			|criteria|
		    | Apple  |
		    | Orange |
