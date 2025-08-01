<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use App\Models\Produk;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        $produks = Produk::with('shop')->get();
        return view('welcome', compact('shops', 'produks'));
    }
}
