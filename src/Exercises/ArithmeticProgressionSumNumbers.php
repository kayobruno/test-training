<?php

declare(strict_types=1);

namespace App\Exercises;

use App\Exercise;
use InvalidArgumentException;

class ArithmeticProgressionSumNumbers implements Exercise
{
    private string $logicalOperator;
    private int $start;
    private int $end;
    private int $termOne;
    private int $termTwo;
    private ?int $termThree;

    public function __construct(
        string $logicalOperator,
        int $start,
        int $end,
        int $termOne,
        int $termTwo,
        int $termThree = null
    ) {
        $this->logicalOperator = $logicalOperator;
        $this->start = $start;
        $this->end = $end;
        $this->termOne = $termOne;
        $this->termTwo = $termTwo;
        $this->termThree = $termThree;

        $this->runValidations();
    }

    public function getAnswer(): int
    {
        $total = 0;
        for ($i = $this->start; $i < $this->end; $i++) {
            if (!is_null($this->termThree)) {
                $this->sumValuesWithAllParameters($total, $i);
                continue;
            }

            $this->sumValuesWithRequiredParameters($total, $i);
        }

        return $total;
    }

    private function sumValuesWithRequiredParameters(int &$total, int &$i)
    {
        if ($this->logicalOperator === '&&' && ($i % $this->termOne === 0 && $i % $this->termTwo === 0)) {
            $total += $i;
        }

        if ($this->logicalOperator === '||' && ($i % $this->termOne === 0 || $i % $this->termTwo === 0)) {
            $total += $i;
        }
    }

    private function sumValuesWithAllParameters(int &$total, int &$i)
    {
        if (
            $this->logicalOperator === '&&'
            && ($i % $this->termOne === 0 && $i % $this->termTwo === 0)
            && ($i % $this->termThree === 0)
        ) {
            $total += $i;
        }

        if (
            $this->logicalOperator === '||'
            && ($i % $this->termOne === 0 || $i % $this->termTwo === 0)
            && ($i % $this->termThree === 0)
        ) {
            $total += $i;
        }
    }

    private function runValidations(): void
    {
        $this->validateLogicalOperator($this->logicalOperator);
        $this->validateRange($this->start, $this->end);
    }

    private function validateLogicalOperator(string $logicalOperator)
    {
        $allowedLogicalOperators = ['&&', '||'];
        if (!in_array($logicalOperator, $allowedLogicalOperators)) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" is not a valid parameter',
                    $logicalOperator
                )
            );
        }
    }

    private function validateRange(int $start, int $end)
    {
        if ($start < 0) {
            throw new InvalidArgumentException('The initial value cannot be less than zero');
        }

        if ($start > $end) {
            throw new InvalidArgumentException('The initial value cannot be greater than the final value');
        }
    }
}
