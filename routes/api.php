<?php

use App\Http\Controllers\Api\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/quote/random', [QuoteController::class, 'random']);
