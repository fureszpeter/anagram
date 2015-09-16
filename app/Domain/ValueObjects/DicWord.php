<?php
namespace Anagram\Domain\ValueObjects;

use Anagram\Domain\Services\SignatureService;
use InvalidArgumentException;

/**
 * Class DicWord.
 *
 * @package Anagram
 *
 * @license Proprietary
 */
class DicWord
{
    const MIN_LENGTH = 2;

    /**
     * @var string
     */
    private $word;

    /**
     * DicWord constructor.
     *
     * @param string $word
     */
    public function __construct($word)
    {
        $this->setWord($word);
    }

    /**
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @param string $word
     *
     * @throws \InvalidArgumentException If argument is not a valid word.
     *
     * @return $this
     */
    private function setWord($word)
    {
        $matches = [];

        if (preg_match('/([^a-zA-Z]+)/', $word, $matches)) {
            throw new InvalidArgumentException(
                sprintf('Word contains invalid character! [%s]', $matches[0])
            );
        }

        if (strlen($word) < self::MIN_LENGTH) {
            throw new InvalidArgumentException(
                sprintf('Too short! [minimum is: %s]', self::MIN_LENGTH)
            );
        }

        $this->word = $word;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getWord();
    }

    /**
     * @TODO Requirements needs this, but maybe author thought casting `__toString`.
     *
     * @return string
     */
    public function toString()
    {
        return $this->getWord();
    }

    /**
     * @return \Anagram\Domain\ValueObjects\DicWord
     */
    public function getSignature()
    {
        $signatureService = new SignatureService();

        return $signatureService->provide($this);
    }

    /**
     * @param \Anagram\Domain\ValueObjects\DicWord $anotherInstance
     *
     * @return bool
     */
    public function signatureEqualsWithInstance(self $anotherInstance)
    {
        return (string) $this->getSignature() === (string) $anotherInstance->getSignature();
    }
}
