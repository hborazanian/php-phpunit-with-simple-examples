<?php

namespace Tests\Feature;

use App\Models\Calculator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CalculatorControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @dataProvider casos
     */
    public function testCreateSub(string $action, int $a, int $b, int $expected)
    {
        $response = $this->call("GET", route("calc-create", [
            "action" => $action,
            "a" => $a,
            "b" => $b
        ]));

        $response->assertStatus(200);
        $this->assertEquals($expected, $response->getContent());

        // apenas para demonstrar assert database
        if ($action == 'add') {
            $this->assertDatabaseHas(Calculator::class, [
                "action" => 'add',
                "a" => $a,
                "b" => $b,
                "result" => $expected,
            ]);
        }
    }

    public function casos(): array
    {
        return [
            ["add", 5, 5, 10],
            ["sub", 10, 5, 5],
            ["div", 10, 2, 5],
            ["mul", 5, 2, 10],
        ];
    }
}
