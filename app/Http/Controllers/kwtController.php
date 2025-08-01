<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use Illuminate\Http\Request;

class kwtController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        return view('kwt', compact('shops'));
    }
}
