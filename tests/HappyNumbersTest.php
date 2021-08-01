<?php

use App\Exercises\HappyNumbers;

class HappyNumbersTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function checkResultIsTrue()
    {
        $exercise = new HappyNumbers(7);
        $answer = $exercise->getAnswer();

        $this->assertTrue($answer);
    }

    /**
     * @test
     */
    public function checkResultIsFalse()
    {
        $exercise = new HappyNumbers(8);
        $answer = $exercise->getAnswer();

        $this->assertFalse($answer);
    }

    /**
     * @test
     */
    public function cannotBeGetResultFromInvalidParams()
    {
        $this->expectException(InvalidArgumentException::class);
        $exercise = new HappyNumbers(-5);
        $exercise->getAnswer();
    }
}
