<?php

namespace App\Services\Strategies;

/**
 * 複利計算クラス
 *
 * 利息を元本に組み入れて、年ごとに増えた元本を基に次の利息を計算する方式。
 */
class CompoundCalculationStrategy implements CalculationStrategy
{
    /**
     * 複利計算処理
     *
     * 計算式: 総額 = 元本 × (1 + 年利) ^ 年数
     */
    public function calculate(float $principal, float $annualRate, int $years, float $monthlyDeposit): int
    {
        $totalMonths = $years * 12;
        $monthlyRate = $annualRate / 100 / 12;

        // 元本に対する複利計算
        $compoundPrincipal = $principal * pow(1 + $monthlyRate, $totalMonths);

        // 毎月積立分の複利計算
        $compoundMonthly = 0;
        if ($monthlyDeposit > 0) {
            $compoundMonthly = $monthlyDeposit * ((pow(1 + $monthlyRate, $totalMonths) - 1) / $monthlyRate);
        }

        $totalAmount = $compoundPrincipal + $compoundMonthly;

        return floor($totalAmount);
    }
}