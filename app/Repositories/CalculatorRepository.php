<?php

namespace App\Repositories;

use App\Models\Calculator;

class CalculatorRepository
{
    public function create(string $action, int $a, int $b, int|float $result): bool
    {
        $newCalculator = new Calculator();
        $newCalculator->action = $action;
        $newCalculator->a = $a;
        $newCalculator->b = $b;
        $newCalculator->result = (float) $result;

        return $newCalculator->save();
    }
}
