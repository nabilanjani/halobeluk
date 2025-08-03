<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use App\Models\Produk;
use Illuminate\Http\Request;

class produkController extends Controller
{
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $categories = Produk::distinct()->pluck('kategori', 'kategori');

        return view('adminbeluk.inputproduk', compact('produk', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'shop' => 'required|exists:shops,id',
            'kategori' => 'required|string|in:umkm,maggot',
        ]);

        $produk = Produk::find($id);
        if (!$produk) {
            return redirect()->route('adminbeluk.inputproduk')->with('error', 'Data tidak ditemukan.');
        }

        // Upload gambar jika ada
        if ($request->hasFile('foto')) {
            $namaFile = time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move(public_path('images'), $namaFile);
            $produk->foto = 'images/' . $namaFile;
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
        $produk = Produk::find($id);
        if (!$produk) {
            return redirect()->route('adminbeluk.inputproduk')->with('error', 'Data tidak ditemukan.');
        }

        $produk->delete();

        return redirect()->route('adminbeluk.inputproduk')->with('success', 'Data Produk berhasil dihapus!');
    }
}
