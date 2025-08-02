<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvestmentSimulationController extends Controller
{
    //
    public function __invoke(Request $request)
    {
        $result = [];
        return response()->json($result);
    }
}
