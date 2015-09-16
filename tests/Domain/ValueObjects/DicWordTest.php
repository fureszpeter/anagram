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
     * @dataProvider validWordProvider
     *
     * @param string $word
     */
    public function testStringCasting($word)
    {
        $dicWord = new DicWord($word);

        $this->assertEquals($word, (string) $dicWord);
    }

    /**
     * @dataProvider validWordProvider
     *
     * @param string $word
     */
    public function testToString($word)
    {
        $dicWord = new DicWord($word);

        $this->assertEquals($word, $dicWord->toString());
    }

    /**
     * @dataProvider validWordWithSignatureProvider
     *
     * @param string $word
     * @param string $signature
     */
    public function testGetSignature($word, $signature)
    {
        $dicWord = new DicWord($word);

        $this->assertEquals($signature, (string) $dicWord->getSignature());
    }

    /**
     * @dataProvider signatureEqualityProvider
     *
     * @param \Anagram\Domain\ValueObjects\DicWord $wordA
     * @param \Anagram\Domain\ValueObjects\DicWord $wordB
     * @param bool $expectedResult
     */
    public function testSignatureEquals(DicWord $wordA, DicWord $wordB, $expectedResult)
    {
        $this->assertEquals(
            $expectedResult,
            $wordA->signatureEqualsWithInstance($wordB)
        );
    }

    /**
     * @return array
     */
    public function signatureEqualityProvider()
    {
        return [
            [
                new DicWord('CbAd'),
                new DicWord('AbCd'),
                true,
            ],
            [
                new DicWord('CbAd'),
                new DicWord('abCd'),
                false,
            ],
        ];
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

    /**
     * @return array
     */
    public function validWordWithSignatureProvider()
    {
        return [
            ['dcb', 'bcd'],
            ['dcba', 'abcd'],
            ['EbdhACfG', 'AbCdEfGh'],
        ];
    }
}
