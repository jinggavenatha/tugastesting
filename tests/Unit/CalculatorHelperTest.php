<?php

namespace Tests\Unit;

use App\Helpers\CalculatorHelper;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CalculatorHelperTest extends TestCase
{
    public function testPerkalian()
    {
        $this->assertEquals(90, CalculatorHelper::perkalian(100, 10));
    }

    public function testMultiplePerkalian()
    {
        $cases = [
            [200, 20, 160],
            [500, 50, 250],
            [1000, 10, 900]
        ];

        foreach ($cases as [$a, $b, $expected]) {
            $this->assertEquals($expected, CalculatorHelper::perkalian($a, $b));
        }
    }

    public function testAddition()
    {
        $this->assertEquals(9, CalculatorHelper::add(4, 5));
    }

    public function testSubtraction()
    {
        $this->assertEquals(1, CalculatorHelper::subtract(3, 2));
    }

    public function testMultipleTestCase()
    {
        $cases = [
            [6, 3, 3],
            [0, 0, 0],
            [-1, 1, 0],
            [10, 5, 15],
        ];

        foreach ($cases as [$a, $b, $expected]) {
            $this->assertEquals($expected, CalculatorHelper::add($a, $b), "Failed on: $a + $b");
        }
    }


    // Alternatif DRY (Dont Repeat Yourself)
    #[DataProvider('additionProvider')]
    public function testAdditionWithDataProvider($a, $b, $expected)
    {
        $this->assertEquals($expected, CalculatorHelper::add($a, $b));
    }

    public static function additionProvider()
    {
        return [
            [2, 3, 5],
            [0, 0, 0],
            [-1, 1, 0],
            [10, 5, 15],
        ];
    }
}