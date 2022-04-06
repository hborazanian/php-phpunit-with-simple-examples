<?php

namespace Tests\Unit\Services;

use App\Repositories\CalculatorRepository;
use App\Services\CalculatorService;
use PHPUnit\Framework\TestCase;

class CalculatorServiceTest extends TestCase
{
    public function testCreateSub()
    {
        $calculatorService = resolve(CalculatorService::class);

        $a = 100;
        $b = 60;
        $expected = 40;

        $result = $calculatorService->sub($a, $b);

        $this->assertEquals($expected, $result);
    }

    public function testCreateDiv()
    {
        $calculatorService = resolve(CalculatorService::class);

        $a = 100;
        $b = 50;
        $expected = 2;

        $result = $calculatorService->div($a, $b);

        $this->assertEquals($expected, $result);
    }

    public function testCreateMul()
    {
        $calculatorService = resolve(CalculatorService::class);

        $a = 100;
        $b = 2;
        $expected = 200;

        $result = $calculatorService->mul($a, $b);

        $this->assertEquals($expected, $result);
    }

    public function testCreateAddSuccessWithMock()
    {
        $calculatorRepository = \Mockery::mock(CalculatorRepository::class);
        $calculatorRepository->shouldReceive('create')->once()->andReturn(true);

        $calculatorService = new CalculatorService($calculatorRepository);

        $a = 100;
        $b = 50;
        $expected = 150;

        $result = $calculatorService->add($a, $b);

        $this->assertEquals($expected, $result);
    }

    public function testCreateAddExceptionWithMock()
    {
        $calculatorRepository = \Mockery::mock(CalculatorRepository::class);
        $calculatorRepository->shouldReceive('create')->once()->andReturn(false);

        $calculatorService = new CalculatorService($calculatorRepository);

        $a = 100;
        $b = 50;

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('erro ao gravar operação');
        $this->expectExceptionCode(501);

        $calculatorService->add($a, $b);
    }
}
