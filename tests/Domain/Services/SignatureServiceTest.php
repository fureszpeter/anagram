<?php
namespace Domain\Services;

use Anagram\Domain\Services\SignatureService;
use Anagram\Domain\ValueObjects\DicWord;
use TestCase;

/**
 * Class SignatureServiceTest.
 *
 * @package Domain
 *
 * @license Proprietary
 */
class SignatureServiceTest extends TestCase
{
    /**
     * @dataProvider dicWordProvider
     *
     * @param \Anagram\Domain\ValueObjects\DicWord $dicWord
     * @param \Anagram\Domain\ValueObjects\DicWord $expectedResult
     */
    public function testProvide(DicWord $dicWord, DicWord $expectedResult)
    {
        $service = new SignatureService();

        $result = $service->provide($dicWord);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @return array
     */
    public function dicWordProvider()
    {
        return [
            [new DicWord('dcb'), new DicWord('bcd')],
            [new DicWord('dcba'), new DicWord('abcd')],
            [new DicWord('EbdhACfG'), new DicWord('AbCdEfGh')],
        ];
    }
}
