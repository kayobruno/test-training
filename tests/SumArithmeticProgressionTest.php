<?php

use App\Exercises\ArithmeticProgressionSumNumbers;
use PHPUnit\Framework\TestCase;

final class SumArithmeticProgressionTest extends TestCase
{
    /**
     * @test
     */
    public function canBeGetResultFromValidParams(): void
    {
        $logicalOperator = '&&';
        $start = 0;
        $end = 1000;
        $termOne = 3;
        $termTwo = 5;

        $exercise = new ArithmeticProgressionSumNumbers($logicalOperator, $start, $end, $termOne, $termTwo);
        $answer = $exercise->getAnswer();

        $this->assertInstanceOf(
            ArithmeticProgressionSumNumbers::class,
            $exercise
        );

        $this->assertIsInt($answer);
    }

    /**
     * @test
     */
    public function cannotBeGetResultFromInvalidParams(): void
    {
        $start = -15;
        $end = -888;
        $termOne = 3;
        $termTwo = 5;
        $logicalOperator = 'pbb';

        $this->expectException(InvalidArgumentException::class);
        new ArithmeticProgressionSumNumbers($logicalOperator, $start, $end, $termOne, $termTwo);
    }

    /**
     * @test
     */
    public function canBeGetValidResultFromThreeAndFiveParams()
    {
        $logicalOperator = '&&';
        $start = 0;
        $end = 1000;
        $termOne = 3;
        $termTwo = 5;
        $correctResult = 33165;

        $exercise = new ArithmeticProgressionSumNumbers($logicalOperator, $start, $end, $termOne, $termTwo);
        $answer = $exercise->getAnswer();

        $this->assertEquals($correctResult, $answer);
    }

    /**
     * @test
     */
    public function canBeGetValidResultFromThreeOrFiveParams()
    {
        $logicalOperator = '||';
        $start = 0;
        $end = 1000;
        $termOne = 3;
        $termTwo = 5;
        $correctResult = 233168;

        $exercise = new ArithmeticProgressionSumNumbers($logicalOperator, $start, $end, $termOne, $termTwo);
        $answer = $exercise->getAnswer();

        $this->assertEquals($correctResult, $answer);
    }

    /**
     * @test
     */
    public function canBeGetValidResultFromThreeOrFiveAndSevenParams()
    {
        $logicalOperator = '||';
        $start = 0;
        $end = 1000;
        $termOne = 3;
        $termTwo = 5;
        $termThree = 7;
        $correctResult = 33173;

        $exercise = new ArithmeticProgressionSumNumbers($logicalOperator, $start, $end, $termOne, $termTwo, $termThree);
        $answer = $exercise->getAnswer();

        $this->assertEquals($correctResult, $answer);
    }
}
