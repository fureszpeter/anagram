<?php
namespace Anagram\Domain\Services;

use Anagram\Domain\ValueObjects\DicWord;

/**
 * Provide signatures for DicWord objects.
 *
 * @package Anagram
 *
 * @license Proprietary
 */
class SignatureService
{
    /**
     * @param \Anagram\Domain\ValueObjects\DicWord $dicWord
     *
     * @return \Anagram\Domain\ValueObjects\DicWord
     */
    public function provide(DicWord $dicWord)
    {
        $stringAsArray = str_split((string) $dicWord);

        natcasesort($stringAsArray);

        return new DicWord(implode('', $stringAsArray));
    }
}
