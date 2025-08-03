<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use App\Models\Artikel;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function dashboard()
    {
        return view('adminbeluk.dashboard');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'owner_name' => 'required|string',
            'phone_number' => 'nullable|string',
            'address' => 'required|string',
            'category' => 'required|in:kwt,lainnya',
            'established_date' => 'nullable|date',
            'link' => 'nullable|string|url',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_path')) {
            $namaFile = time() . '.' . $request->file('image_path')->getClientOriginalExtension();
            $request->file('image_path')->move(public_path('storage/images'), $namaFile);
            $imagePath = 'images/' . $namaFile;
        }

        Shop::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'owner_name' => $validated['owner_name'],
            'phone_number' => $validated['phone_number'],
            'address' => $validated['address'],
            'category' => $validated['category'],
            'established_date' => $validated['established_date'],
            'link' => $validated['link'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('adminbeluk.inputkwt.store')->with('success', 'Berhasil menambahkan');
    }

    public function article(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|in:umkm,limbah,maggot,pemasaran',
            'diterbitkan_pada' => 'required|date',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('image_path')) {
            $namaFile = time() . '.' . $request->file('image_path')->getClientOriginalExtension();
            $request->file('image_path')->move(public_path('storage/images'), $namaFile);
            $gambarPath = 'images/' . $namaFile;
        }

        Artikel::create([
            'judul' => $validated['judul'],
            'konten' => $validated['konten'],
            'kategori' => $validated['kategori'],
            'diterbitkan_pada' => $validated['diterbitkan_pada'],
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('adminbeluk.inputartikel.article')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function produk(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'shop' => 'required|exists:shops,id',
            'kategori' => 'required|string|in:umkm,maggot',
        ]);

        $imagePath = null;
        if ($request->hasFile('foto')) {
            $namaFile = time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move(public_path('storage/images'), $namaFile);
            $imagePath = 'images/' . $namaFile;
        }

        Produk::create([
            'nama_produk' => $validated['nama_produk'],
            'harga' => $validated['harga'],
            'foto' => $imagePath,
            'shop_id' => $validated['shop'],
            'kategori' => $validated['kategori'],
        ]);

        return redirect()->route('adminbeluk.inputproduk.produk')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $shop = Shop::find($id);

        if (!$shop) {
            return redirect()->route('adminbeluk.inputkwt')->with('error', 'Data tidak ditemukan.');
        }

        $categories = Shop::distinct()->pluck('category', 'category');

        return view('adminbeluk.edit', compact('shop', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'established_date' => 'required|date',
            'address' => 'required|string',
            'link' => 'required|url',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'category' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $shop = Shop::find($id);
        if (!$shop) {
            return redirect()->route('adminbeluk.inputkwt')->with('error', 'Data tidak ditemukan.');
        }

        if ($request->hasFile('image_path')) {
            $namaFile = time() . '.' . $request->file('image_path')->getClientOriginalExtension();
            $request->file('image_path')->move(public_path('storage/images'), $namaFile);
            $shop->image_path = 'images/' . $namaFile;
        }

        $shop->update([
            'name' => $request->name,
            'owner_name' => $request->owner_name,
            'phone_number' => $request->phone_number,
            'established_date' => $request->established_date,
            'address' => $request->address,
            'link' => $request->link,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->route('adminbeluk.inputkwt')->with('success', 'Data KWT berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $shop = Shop::find($id);
        if (!$shop) {
            return redirect()->route('adminbeluk.inputkwt')->with('error', 'Data tidak ditemukan.');
        }

        $shop->delete();
        return redirect()->route('adminbeluk.inputkwt')->with('success', 'Data KWT berhasil dihapus!');
    }

    public function inputproduk()
    {
        $shops = Shop::all();
        $produks = Produk::all();
        $produk = Produk::first();
        $categories = Produk::distinct()->pluck('kategori', 'kategori');
        return view('adminbeluk.inputproduk', compact('shops', 'produks', 'categories', 'produk'));
    }

    public function inputkwt()
    {
        $shops = Shop::all();
        $categories = Shop::distinct()->pluck('category', 'category');
        return view('adminbeluk.inputkwt', compact('shops', 'categories'));
    }

    public function inputartikel()
    {
        $shops = Shop::all();
        $artikels = Artikel::all();
        $categories = Artikel::distinct()->pluck('kategori', 'kategori');
        return view('adminbeluk.inputartikel', compact('shops', 'artikels', 'categories'));
    }
}
