<?php

namespace App\Http\Controllers;
use App\Models\Artikel;
use Illuminate\Http\Request;

class artikelController extends Controller
{
    public function edit($id)
    {
        // Ambil data Artikel berdasarkan ID
        $artikel = Artikel::find($id);
        
        if (!$artikel) {
            return redirect()->route('adminbeluk.inputartikel')->with('error', 'Data tidak ditemukan.');
        }

        $categories = Artikel::distinct()->pluck('kategori', 'kategori');

        // Tampilkan halaman edit dengan data artikel
        return view('adminbeluk.edit', compact('artikel', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|in:umkm,limbah,maggot,pemasaran',
            'diterbitkan_pada' => 'required|date',
        ]);

        // Cari Artikel yang ingin diupdate
        $artikel = Artikel::find($id);

        if (!$artikel) {
            return redirect()->route('adminbeluk.inputartikel')->with('error', 'Data tidak ditemukan.');
        }

        // Proses upload gambar jika ada
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('artikel', 'public');
            $artikel->image_path = $imagePath;
        }

        // Update data
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
        // Cari data berdasarkan ID
        $artikel = Artikel::find($id);
        
        if (!$artikel) {
            return redirect()->route('adminbeluk.inputartikel')->with('error', 'Data tidak ditemukan.');
        }

        // Hapus data
        $artikel->delete();

        return redirect()->route('adminbeluk.inputartikel')->with('success', 'Data Artikel berhasil dihapus!');
    }
}
