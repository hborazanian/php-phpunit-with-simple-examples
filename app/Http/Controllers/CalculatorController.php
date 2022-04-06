<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCalculatorRequest;
use App\Http\Requests\UpdateCalculatorRequest;
use App\Models\Calculator;
use App\Services\CalculatorService;
use JetBrains\PhpStorm\Pure;

class CalculatorController extends Controller
{
    public function __construct(private CalculatorService $calculatorService) {}

    public function create(string $action, int $a, int $b): string
    {
        return match ($action) {
            'add' => $this->calculatorService->add($a, $b),
            'sub' => $this->calculatorService->sub($a, $b),
            'div' => $this->calculatorService->div($a, $b),
            'mul' => $this->calculatorService->mul($a, $b),
            default => 'action not found',
        };
    }
}
