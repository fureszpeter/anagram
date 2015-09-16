<?php
namespace Domain\ValueObjects;

use Anagram\Domain\ValueObjects\DicWord;
use InvalidArgumentException;
use TestCase;

/**
 * Test for DicWord.
 *
 * @package Anagram
 *
 * @license Proprietary
 */
class DicWordTest extends TestCase
{
    /**
     * @dataProvider invalidWordProvider
     *
     * @param string $word The invalid word.
     * @param string $expectedException The name of the Exception.
     * @param string $message The expected Exception message.
     */
    public function testCreateInstanceWillThrowException($word, $expectedException, $message = '')
    {
        $this->setExpectedException($expectedException, $message !== ''?:null);

        new DicWord($word);
    }

    /**
     * @dataProvider validWordProvider
     *
     * @param string $word
     */
    public function testCreateInstanceWithValidWords($word)
    {
        $dicWord = new DicWord($word);

        $this->assertEquals($word, $dicWord->getWord());
    }

    /**
     * @return array
     */
    public function invalidWordProvider()
    {
        return [
            //Contains invalid character
            ['this!is invalid', InvalidArgumentException::class, 'invalid'],
            ['123213', InvalidArgumentException::class, 'invalid'],
            //Too short
            ['a', InvalidArgumentException::class, 'short'],
        ];
    }

    /**
     * @return array
     */
    public function validWordProvider()
    {
        return [
            ['ThisIsAValidWord'],
            ['thi'],
        ];
    }
}
