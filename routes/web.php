<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvestmentSimulationController;

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/simulations', InvestmentSimulationController::class);
