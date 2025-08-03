<?php

namespace App\Http\Controllers;
use App\Models\Artikel;
use Illuminate\Http\Request;

class artikelController extends Controller
{
    public function edit($id)
    {
        $artikel = Artikel::find($id);
        
        if (!$artikel) {
            return redirect()->route('adminbeluk.inputartikel')->with('error', 'Data tidak ditemukan.');
        }

        $categories = Artikel::distinct()->pluck('kategori', 'kategori');

        return view('adminbeluk.edit', compact('artikel', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|in:umkm,limbah,maggot,pemasaran',
            'diterbitkan_pada' => 'required|date',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $artikel = Artikel::find($id);
        if (!$artikel) {
            return redirect()->route('adminbeluk.inputartikel')->with('error', 'Data tidak ditemukan.');
        }

        // Upload gambar baru jika ada
        if ($request->hasFile('image_path')) {
            $namaFile = time() . '.' . $request->file('image_path')->getClientOriginalExtension();
            $request->file('image_path')->move(public_path('storage/images'), $namaFile);
            $artikel->gambar = 'images/' . $namaFile;
        }

        // Update data artikel
        $artikel->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kategori' => $request->kategori,
            'diterbitkan_pada' => $request->diterbitkan_pada,
        ]);

        return redirect()->route('adminbeluk.inputartikel')->with('success', 'Data Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $artikel = Artikel::find($id);
        
        if (!$artikel) {
            return redirect()->route('adminbeluk.inputartikel')->with('error', 'Data tidak ditemukan.');
        }

        $artikel->delete();

        return redirect()->route('adminbeluk.inputartikel')->with('success', 'Data Artikel berhasil dihapus!');
    }
}
