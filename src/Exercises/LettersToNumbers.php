<?php

declare(strict_types=1);

namespace App\Exercises;

use App\Exercise;
use InvalidArgumentException;

class LettersToNumbers implements Exercise
{
    public string $word;

    public function __construct(string $word)
    {
        if (is_null($word)) {
            throw new InvalidArgumentException('the parameter cannot be null');
        }

        $this->word = $word;
    }

    public function getAnswer(): array
    {
        $value = $this->convertLettersToNumber($this->word);
        $happyNumber = new HappyNumbers($value);

        return [
            'is_multiple_three_or_five' => $this->isMultipleThreeOrFive($value),
            'is_happy_number' => $happyNumber->getAnswer(),
            'is_prime_number' => $this->isPrimeNumber($value),
        ];
    }

    private function convertLettersToNumber(string $word): int
    {
        $letters = array_merge(range('a', 'z'), range('A', 'Z'));
        $letters = array_flip($letters);

        $total = 0;
        for ($i=0; $i < strlen($word); $i++) {
            $letter = $word[$i];
            if (!isset($letters[$letter])) {
                continue;
            }

            $total += $letters[$letter] + 1;
        }

        return $total;
    }

    private function isMultipleThreeOrFive(int $number): bool
    {
        return ($number % 3 === 0) || ($number % 5 ===0);
    }

    private function isPrimeNumber(int $number): bool
    {
        if ($number <= 1)
            return false;

        for ($i=2; $i <= $number/2; $i++) {
            if ($number % $i === 0)
                return false;
        }

        return true;
    }
}
