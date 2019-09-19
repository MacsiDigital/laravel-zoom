# Changelog

All notable changes to `laravel-zoom` will be documented in this file

## 1.0.15 - 2019-08-02

Update $query_attributes to $queryAttributes to be in line

## 1.0.14 - 2019-07-28

Bug fix on issue with registrant relationship

## 1.0.13 - 2019-07-26

Bug fix on multiple relationships

## 1.0.12 - 2019-07-26

Change getResponse method to a none static method

## 1.0.11 - 2019-07-26

Change Model to return itself on save instead of the array response

## 1.0.10 - 2019-07-26

replace Guzzle getContents with getBody

## 1.0.9 - 2019-07-26

Fix issue with Facade

## 1.0.8 - 2019-07-26

Added return statements to various methods to allow chaining.

Bug Fix:
	When creating a new meeting for an existing contact the userID would not pass if it was set before the create method.  We now pass the userID in teh make statement if its set.

## 1.0.7 - 2019-07-25

Update models to use new query return function

## 1.0.6 - 2019-07-25

Fix type

## 1.0.5 - 2019-07-25

Change where clause to act like Laravel.

You can now do either

where('key', 'value')

or

where('key', '=', 'value')

## 1.0.4 - 2019-07-25

Update all relationship models to use getID function

## 1.0.3 - 2019-07-25

Update delete method and other functions to use GetID function

## 1.0.2 - 2019-07-25

Update create method to use the static make method

## 1.0.1 - 2019-07-25

- Bug fixes :-
	Removed bug when deleting
	Removed bug when selecting multiple records

## 1.0.0 - 2019-06-26

- Initial release
