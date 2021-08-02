<?php

use App\Exercises\LettersToNumbers;
use PHPUnit\Framework\TestCase;

class LettersToNumbersTest extends TestCase
{
    /**
     * @test
     */
    public function checkResultIsArray()
    {
        $exercise = new LettersToNumbers('Foo bar');
        $answer = $exercise->getAnswer();
        $this->assertIsArray($answer);
    }

    /**
     * @test
     */
    public function cannotBeGetResultFromInvalidParams()
    {
        $this->expectException(InvalidArgumentException::class);
        $exercise = new LettersToNumbers('123456464');
        $exercise->getAnswer();
    }
}
