<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class artikelController extends Controller
{
    // Menampilkan form edit artikel
    public function edit($id)
    {
        $artikel = Artikel::find($id);
        
        if (!$artikel) {
            return redirect()->route('adminbeluk.inputartikel')->with('error', 'Data tidak ditemukan.');
        }

        // Ambil kategori unik dari tabel Artikel
        $categories = Artikel::distinct()->pluck('kategori', 'kategori');

        return view('adminbeluk.edit', compact('artikel', 'categories'));
    }

    // Proses update artikel
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|in:umkm,limbah,maggot,pemasaran',
            'diterbitkan_pada' => 'required|date',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Cari artikel
        $artikel = Artikel::find($id);
        if (!$artikel) {
            return redirect()->route('adminbeluk.inputartikel')->with('error', 'Data tidak ditemukan.');
        }

        // Siapkan data untuk diupdate
        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kategori' => $request->kategori,
            'diterbitkan_pada' => $request->diterbitkan_pada,
        ];

        // Kalau ada gambar baru
        if ($request->hasFile('image_path')) {
            // Hapus gambar lama kalau ada
            if ($artikel->gambar && file_exists(public_path($artikel->gambar))) {
                unlink(public_path($artikel->gambar));
            }

            // Simpan gambar baru
            $namaFile = time() . '.' . $request->file('image_path')->getClientOriginalExtension();
            $request->file('image_path')->move(public_path('images'), $namaFile);
            $data['gambar'] = 'images/' . $namaFile;
        }

        // Update artikel
        $artikel->update($data);

        return redirect()->route('adminbeluk.inputartikel')->with('success', 'Data Artikel berhasil diperbarui!');
    }

    // Hapus artikel
    public function destroy($id)
    {
        $artikel = Artikel::find($id);
        
        if (!$artikel) {
            return redirect()->route('adminbeluk.inputartikel')->with('error', 'Data tidak ditemukan.');
        }

        // Hapus file gambar kalau ada
        if ($artikel->gambar && file_exists(public_path($artikel->gambar))) {
            unlink(public_path($artikel->gambar));
        }

        $artikel->delete();

        return redirect()->route('adminbeluk.inputartikel')->with('success', 'Data Artikel berhasil dihapus!');
    }
}
