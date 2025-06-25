<?php

namespace App\Http\Controllers;

use App\Helpers\CalculatorHelper;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('calculator');
    }

    public function discount(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'discount' => 'required|numeric',
        ]);

        $amount = $request->input('amount');
        $discount = $request->input('discount');

        $result = CalculatorHelper::discount($amount, $discount);

        return redirect()->back()->with('result', "Harga setelah diskon: $result");
    }

    public function add(Request $request)
    {
        $request->validate([
            'a' => 'required|numeric',
            'b' => 'required|numeric',
        ]);

        $a = $request->input('a');
        $b = $request->input('b');

        $result = CalculatorHelper::add($a, $b);

        return redirect()->back()->with('result', "Hasil penjumlahan: $result");
    }

    public function subtract(Request $request)
    {
        $request->validate([
            'a' => 'required|numeric',
            'b' => 'required|numeric',
        ]);

        $a = $request->input('a');
        $b = $request->input('b');

        $result = CalculatorHelper::subtract($a, $b);

        return redirect()->back()->with('result', "Hasil pengurangan: $result");
    }
}
