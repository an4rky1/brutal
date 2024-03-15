<?php

use App\Http\Controllers\Api\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('poster');
});

Route::get('/api/quote/random', [QuoteController::class, 'random']);
Route::get('/api/quote/count', [QuoteController::class, 'count']);
