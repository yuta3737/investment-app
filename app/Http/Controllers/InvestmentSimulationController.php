<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SimulationService;
use App\Services\Strategies\SimpleCalculationStrategy;
use App\Services\Strategies\CompoundCalculationStrategy;

class InvestmentSimulationController extends Controller
{

    /**
     * 投資計算の実行
     *
     * @param Request $request リクエストパラメータ
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculate(Request $request)
    {
        // 入力値検証
        $validated = $request->validate([
            'principal'        => 'required|numeric|min:0',      // 元本
            'annual_rate'      => 'required|numeric|min:0',      // 年利
            'years'            => 'required|integer|min:1',      // 運用年数
            'type'             => 'nullable|in:simple,compound', // 計算タイプ
            'monthly_deposit'  => 'required|numeric|min:0',      // 毎月の積立額
        ]);

        // デフォルトは複利計算
        $type = $validated['type'] ?? 'compound';

        // パラメータに応じて計算戦略を選択
        $strategy = match ($type) {
            'simple' => new SimpleCalculationStrategy(),
            'compound' => new CompoundCalculationStrategy(),
            default    => new CompoundCalculationStrategy(), // デフォルトは複利
        };

        // サービスに戦略を渡して計算実行
        $service = new SimulationService($strategy);
        $result = $service->simulate($validated['principal'], $validated['annual_rate'], $validated['years'], $validated['monthly_deposit']);

        // JSONレスポンスとして返却
        return response()->json([
            'result' => $result,
            'calculation_type' => $type
        ]);
    }







    //
    // public function __invoke(Request $request)
    // {
    //     $validated = $request->validate([
    //         'principal' => 'required|numeric|min:0',
    //         'rate' => 'required|numeric|min:0',
    //         'years' => 'required|integer|min:1',
    //         'strategy' => 'nullable|string|in:compound,simple',
    //     ]);

    //     $strategyType = $validated['strategy'] ?? 'compound';

    //     $result = $this->calculate(
    //         $validated['principal'],
    //         $validated['rate'],
    //         $validated['years']
    //     );


    //     return response()->json([
    //         'result' => $result,
    //         'strategy' => $strategyType,
    //     ]);
    // }

    // public function calculate(float $principal, float $rate, int $years): array
    // {
    //     $rate = $rate / 100;
    //     $total = $principal * pow(1 + $rate, $years);
    //     return [
    //         'total_amount' => floor($total) . '円',
    //         'profit' => floor($total - $principal) . '円',
    //     ];
    // }
}
