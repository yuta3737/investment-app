<?php

namespace App\Services\Strategies;

/**
 * 単利計算クラス
 *
 * 元本に対して毎年一定の利息を加える単純な計算方式。
 */
class SimpleCalculationStrategy implements CalculationStrategy
{
    /**
     * 単利計算処理
     *
     * 計算式: 総額 = 元本 + (元本 × 年利 × 年数)
     */
    public function calculate(float $principal, float $annualRate, int $years, float $monthlyDeposit): int
    {
        // 単利計算
        $totalMonths = $years * 12;
        $rate = $annualRate / 100;

        // 元本に対する単利
        $principalInterest = $principal * $rate * $years;

        // 毎月積立は単純加算（利息なしの場合）
        $monthlyTotal = $monthlyDeposit * $totalMonths;

        $totalAmount = $principal + $principalInterest + $monthlyTotal;

        return floor($totalAmount);
    }
}