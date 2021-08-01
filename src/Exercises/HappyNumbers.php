<?php

declare(strict_types=1);

namespace App\Exercises;

use App\Exercise;
use InvalidArgumentException;

class HappyNumbers implements Exercise
{
    private int $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function getAnswer(): bool
    {
        if ($this->number <= 0) {
            throw new InvalidArgumentException('the number cannot be less than or equal zero');
        }

        return $this->isHappy($this->number);
    }

    private function isHappy(int $number): bool
    {
        $slow = $number;
        $fast = $number;
        while(true)
        {
            $slow = $this->numSquareSum($slow);
            $fast = $this->numSquareSum($this->numSquareSum($fast));

            if (($slow !== $fast)) {
                continue;
            }

            break;
        }

        return ($slow === 1);
    }

    private function numSquareSum(int $number)
    {
        $squareSum = 0;
        while ($number)
        {
            $squareSum += ($number % 10) * ($number % 10);
            $number /= 10;
        }

        return $squareSum;
    }
}
