<?php
namespace Anagram\Domain\Entities;

use Anagram\Domain\ValueObjects\DicWord;
use InvalidArgumentException;
use JsonSerializable;

/**
 * Class DicAnagrams.
 *
 * @package Anagram
 *
 * @license Proprietary
 */
class DicAnagrams implements JsonSerializable
{
    /**
     * @var \Anagram\Domain\ValueObjects\DicWord[]
     */
    private $dicWords;

    /**
     * @param \Anagram\Domain\ValueObjects\DicWord ...$dicWords
     *
     * @throws \InvalidArgumentException If no word provided.
     */
    public function __construct(DicWord ...$dicWords)
    {
        if (empty($dicWords)) {
            throw new InvalidArgumentException('Must provide minimum one DicWord.');
        }

        $this->dicWords = $dicWords;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $anagrams = [];
        foreach ($this->dicWords as $dicWord) {
            $anagrams[$dicWord->toString()] = array_map(
                function (DicWord $value) {
                    return $value->toString();
                },
                $this->getAnagrams($dicWord)
            );
        }

        return ['dictionary' => $anagrams];
    }

    /**
     * @param \Anagram\Domain\ValueObjects\DicWord $dicWord
     *
     * @return \Anagram\Domain\ValueObjects\DicWord[]
     */
    public function getAnagrams(DicWord $dicWord)
    {
        return array_values(
            array_filter(
                $this->dicWords,
                function (DicWord $value) use ($dicWord) {
                    return $dicWord->signatureEqualsWithInstance($value);
                }
            )
        );
    }
}
