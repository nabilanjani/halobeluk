<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use App\Models\Produk;
use Illuminate\Http\Request;

class produkController extends Controller
{
    public function edit($id)
    {
        // Ambil data Produk berdasarkan ID
        $produks = Produk::find($id);
        
        if (!$produks) {
            return redirect()->route('adminbeluk.inputproduk')->with('error', 'Data tidak ditemukan.');
        }

        $categories = Produk::distinct()->pluck('category', 'category');

        // Tampilkan halaman edit dengan data produk
        return view('adminbeluk.edit', compact('produks', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'shop' => 'required|exists:shops,id',
            'kategori' => 'required|string|in:umkm,maggot',
        ]);

        // Cari KWT yang ingin diupdate
        $produk = Produk::find($id);

        if (!$produk) {
            return redirect()->route('adminbeluk.inputproduk')->with('error', 'Data tidak ditemukan.');
        }

        // Proses upload gambar jika ada
        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('produk', 'public');
            $produk->image_path = $imagePath;
        }

        // Update data
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'shop_id' => $request->shop,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('adminbeluk.inputproduk')->with('success', 'Data Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $produk = Produk::find($id);
        
        if (!$produk) {
            return redirect()->route('adminbeluk.inputproduk')->with('error', 'Data tidak ditemukan.');
        }

        // Hapus data
        $produk->delete();

        return redirect()->route('adminbeluk.inputproduk')->with('success', 'Data Produk berhasil dihapus!');
    }
}
