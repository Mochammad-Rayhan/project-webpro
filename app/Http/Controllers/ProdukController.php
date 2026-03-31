<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $produk = Produk::orderBy('updated_at' , 'desc')->get();
        // return view('backend.v_produk.index' , [
        //     'judul' => 'Data Produk Kosmetik',
        //     'index' => $produk
        // ]);

        $search = $request->search;

        $produk = Produk::when($search, function ($query, $search) {
            $query->where('nama_produk', 'like', "%{$search}%")
                ->orWhereHas('kategori', function ($q) use ($search) {
                    $q->where('kode', 'like', "%{$search}%");
                });
        })
        ->orderBy('updated_at', 'desc')
        ->paginate(5);

        return view('backend.v_produk.index', [
            'judul' => 'Data Produk Kosmetik',
            'index' => $produk
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori' , 'asc')->get();
        return view('backend.v_produk.create' , [
            'judul' => 'Tambah Produk' ,
            'kategori' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode' => 'required',
            'nama_produk' => 'required|max:100|unique:produk',
            'harga_satuan' => 'required|numeric|min:0',
            // 'stok' => 'required|min:1' ,
            'tanggal_masuk' => 'required' ,
            'kadaluarsa' => 'required'
        ]);

        $validateData['stok'] = 0;
        Produk::create($validateData);
        return redirect()->route('backend.produk.index')->with('success' , "data berhasil tersimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::orderBy('nama_kategori' , 'asc')->get();
        $produk = Produk::find($id);
        return view('backend.v_produk.edit' , [
            'judul' => 'Edit Produk',
            'edit' => $produk,
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'kode' => 'required',
            'nama_produk' => 'required|max:100',
            'harga_satuan' => 'required|numeric|min:0',
            // 'stok' => 'required|min:1' ,
            'tanggal_masuk' => 'required' ,
            'kadaluarsa' => 'required'
        ];

        $validateData = $request->validate($rules);
        Produk::where('id_produk' , $id)->update($validateData);
        return redirect()->route('backend.produk.index')->with('success' , 'Data Berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->route('backend.produk.index')->with('success' , 'Data berhasil dihapus');
    }
}
