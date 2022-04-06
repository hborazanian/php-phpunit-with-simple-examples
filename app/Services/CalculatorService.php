<?php

namespace App\Services;

use App\Repositories\CalculatorRepository;

class CalculatorService
{
    public function __construct(private CalculatorRepository $calculatorRepository) {}

    public function add(int $a, int $b): int
    {
        $result = $a + $b;

        if (!$this->calculatorRepository->create('add', $a, $b, $result)) {
            throw new \Exception('erro ao gravar operação', 501);
        };

        return $result;
    }

    public function sub(int $a, int $b): int
    {
        return $a - $b;
    }

    public function div(int $a, int $b): float
    {
        return (float) ($a / $b);
    }

    public function mul(int $a, int $b): int
    {
        return $a * $b;
    }
}
