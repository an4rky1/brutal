<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function random(Request $request)
    {
        $viewed = $request->session()->get('viewed_quotes', []);

        $available = Quote::whereNotIn('id', $viewed)->inRandomOrder()->first();

        if (!$available) {
            $request->session()->forget('viewed_quotes');
            $available = Quote::inRandomOrder()->first();
        }

        $request->session()->push('viewed_quotes', $available->id);

        return response()->json($available);
    }

    public function count()
    {
        return response()->json(['count' => Quote::count()]);
    }
}
