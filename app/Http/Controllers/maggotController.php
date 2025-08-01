<?php

namespace App\Http\Controllers;
use App\Models\Artikel;
use Illuminate\Http\Request;

class maggotController extends Controller
{
    public function index()
    {
        $artikels = Artikel::all();
        return view('maggot', compact('artikels'));
    }
    public function show($id)
    {
        $artikel = Artikel::findOrFail($id); // Menemukan artikel berdasarkan ID
        return view('artikel', compact('artikel')); // Kirim data artikel ke view
    }
}
