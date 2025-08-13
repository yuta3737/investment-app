<?php

namespace App\Services\Strategies;

interface CalculationStrategy
{
    /**
     * 計算処理
     *
     * @param float $principal   元本（円）
     * @param float $annualRate  年利（％）
     * @param int   $years       運用年数
     * @return int              計算後の総額
     */
    public function calculate(float $principal, float $annualRate, int $years, float $monthlyDeposit): int;
}