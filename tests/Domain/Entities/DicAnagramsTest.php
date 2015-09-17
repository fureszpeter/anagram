<?php
namespace Domain\Entities;

use Anagram\Domain\Entities\DicAnagrams;
use Anagram\Domain\ValueObjects\DicWord;
use TestCase;

/**
 * Class DicAnagramsTest.
 *
 * @package Domain
 *
 * @license Proprietary
 */
class DicAnagramsTest extends TestCase
{
    public function testGetAnagrams()
    {
        $dictionary = new DicAnagrams(
            new DicWord('AppleTreeIsNiceTree'),
            new DicWord('TreeIsNiceAppleTree'),
            new DicWord('IsTreeNiceAppleTree'),
            new DicWord('SomethingElse')
        );

        $result = $dictionary->getAnagrams(
            new DicWord('IsTreeNiceAppleTree')
        );

        $this->assertEquals(
            [
                new DicWord('AppleTreeIsNiceTree'),
                new DicWord('TreeIsNiceAppleTree'),
                new DicWord('IsTreeNiceAppleTree'),
            ],
            $result
        );
    }

    public function testJsonEncode()
    {
        $dictionary = new DicAnagrams(
            new DicWord('AppleTreeIsNiceTree'),
            new DicWord('TreeIsNiceAppleTree'),
            new DicWord('IsTreeNiceAppleTree'),
            new DicWord('SomethingElse')
        );

        $json = json_encode($dictionary, JSON_PRETTY_PRINT);

        $this->assertJson($json);
        $this->assertJsonStringEqualsJsonString(
            '{
                "dictionary": {
                    "AppleTreeIsNiceTree": [
                        "AppleTreeIsNiceTree",
                        "TreeIsNiceAppleTree",
                        "IsTreeNiceAppleTree"
                    ],
                    "TreeIsNiceAppleTree": [
                        "AppleTreeIsNiceTree",
                        "TreeIsNiceAppleTree",
                        "IsTreeNiceAppleTree"
                    ],
                    "IsTreeNiceAppleTree": [
                        "AppleTreeIsNiceTree",
                        "TreeIsNiceAppleTree",
                        "IsTreeNiceAppleTree"
                    ],
                    "SomethingElse": [
                        "SomethingElse"
                    ]
                }
            }',
            $json
        );
    }
}
