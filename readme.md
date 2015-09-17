#PHP Test
##Summary:

A relatively simple PHP RESTAPI to demonstrate your PHP Coding level, approach to development and ability to translate 
requirements into working code (that can be understood and adapted by other PHP developers).

Language: PHP (OOP style)
Framework: You must use your prefered PHP MVC framework (eg, Laravel, Symfony etc)
Time required: approx 3 hours

##The Assignment:

To create a dictionary of anagrams for a given list of words.

For the purposes of this assignment:

- an “anagram” of a word is: another word obtained through permutations of its
characters. For example:

 - “saco” is an anagram of “cosa”, and
 - “mora” is an anagram of “amor” and “roma”.
 -  A word is an anagram of another word if both words have the same “signature”.
 - The “signature” of a word is: The result of alphabetically ordering the letters in the word. For example:
    ○ the signature of “saco” is “acos”;
    ○ the signature of “cosa” is “acos”, and
    ○ the signature of “exam” is “aemx”.
    ● A word is always an anagram of itself.
    ● A dictionary of anagrams will search only for anagrams based on the words in the dictionary.

### Your solutions should have:

1. A class DicWord to represent a word within a dictionary. This class should
have/facilitate:
    a. DicWord Instance creation given the string of the word;
    b. accessor for the word string
    c. accessor for the word signature
    d. method to test signature equality between DicWord instances
    e. method toString() to give a string representation of the DicWord (ie just the word string)

2. A class DicAnagrams representing a dictionary which can hold a collection of DicWord instances 
(you may use interfaces if you wish) and should be able to:
    a. Given a DicWord, return all of the DicWords from it’s internal collection that are anagrams of the given DicWord.
    b. Generate a JSON ‘Anagram Dictionary’ in the format shown below:

```
{
"dictionary": [
{"amor": ["amor","mora","ramo","roma"]},
{"coro": ["coro"]},
{"cosa": ["cosa","saco"]},
{"mora": ["amor","mora","ramo","roma"]},
{"ramo": ["amor","mora","ramo","roma"]},
{"roma": ["amor","mora","ramo","roma"]},
{"saco": ["cosa","saco"]}
]
}
```

3. All classes must be provided with unit tests (ideally in phpunit or phpspec). These tests should:
    a. ensure that the objects under test represent what is required of them as defined above
    b. explore exceptional circumstances

4. A simple REST API for this assignment will have the single endpoint below. It will take a single query string 
parameter ‘words’ as a ‘space’ separated list of words which will populate the dictionary and should return a JSON 
result as formatted in `2b` GET `/api/dic/anagrams`

5. When the endpoint is called with the exact parameters as below, it will produce
exactly the Anagram Dictionary output shown in 2b above (whitespace excepted)
/api/dic/anagrams?words=amor+coro+cosa+mora+roma+ramo+saco

###Bonus:

Database code is outside the scope of this assignment, but for ‘bonus points’ we’d like you
to suggest API endpoints that would enable multiple dictionaries to be accessed, for CRUD
operations for individual words within a specific dictionary, and for anagrams for a specific
word in a specific dictionary to be accessed.


GOOD LUCK! :)
