<?php

namespace App\Services;

use App\Services\Strategies\CalculationStrategy;
use Illuminate\Support\Facades\Log;

/**
 * 投資シミュレーションサービス
 *
 * Strategyパターンを利用し、注入された計算方式に応じて
 * 投資シミュレーションを実行する。
 */
class SimulationService
{
    /** @var CalculationStrategy 選択された計算戦略 */
    private CalculationStrategy $strategy;

    /**
     * コンストラクタで計算戦略を注入
     */
    public function __construct(CalculationStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * シミュレーション実行
     *
     * @param float $principal   元本（円）
     * @param float $annualRate  年利（％）
     * @param int   $years       年数
     * @return int               総額
     */
    public function simulate(float $principal, float $annualRate, int $years, float $monthlyDeposit): int
    {
        $totalAmount = $this->strategy->calculate($principal, $annualRate, $years, $monthlyDeposit);
        Log::debug($totalAmount);

        return $totalAmount;
    }
}