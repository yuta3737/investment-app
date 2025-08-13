<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvestmentSimulationController;

Route::post('/simulations', [InvestmentSimulationController::class, 'calculate']);