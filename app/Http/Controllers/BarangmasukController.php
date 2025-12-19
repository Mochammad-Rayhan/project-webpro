<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\User;

class BarangmasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $masuk = BarangMasuk::orderBy('updated_at' , 'desc')->get();
        // return view('backend.v_masuk.index' , [
        //     'judul' => "Data Barang Masuk Beauty Care",
        //     'index' => $masuk
        // ]);
        $search = $request->search;
        $masuk = BarangMasuk::with(['produk', 'supplier', 'user'])
            ->when($search, function ($query, $search) {
                $query->whereHas('produk', function ($q) use ($search) {
                        $q->where('nama_produk', 'like', "%{$search}%");
                    })
                    ->orWhereHas('supplier', function ($q) use ($search) {
                        $q->where('kode_supplier', 'like', "%{$search}%");
                    })
                    ->orWhere('tanggal_masuk', 'like', "%{$search}%");
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(5);

        return view('backend.v_masuk.index', [
            'judul' => "Data Barang Masuk Beauty Care",
            'index' => $masuk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produk = Produk::orderBy('id_produk' , 'asc')->get();
        $supplier = Supplier::orderBy('kode_supplier' , 'asc')->get();
        $user = User::orderBy('id_admin' , 'asc')->get();
        return view('backend.v_masuk.create' , [
            'judul' => 'Tambah Barang Masuk',
            'produk' => $produk,
            'supplier' => $supplier,
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id_produk' => 'required',
            'kode_supplier' => 'required',
            'id_admin' => 'required',
            'jumlah_masuk' => 'required',
            'harga_beli' => 'required',
            'tanggal_masuk' => 'required'
        ]);

        $total_masuk = $request->jumlah_masuk * $request->harga_beli;

        BarangMasuk::create([
            'id_produk' => $request->id_produk,
            'kode_supplier' => $request->kode_supplier,
            'id_admin' => $request->id_admin,
            'jumlah_masuk' => $request->jumlah_masuk,
            'harga_beli' => $request->harga_beli,
            'tanggal_masuk' => $request->tanggal_masuk,
            'total_masuk' => $total_masuk,
        ]);

        $produk = Produk::find($request->id_produk);
        if(!$produk) {
            return back()->with('error' , 'Produk tidak ditemukan');
        }
        $produk->stok += $request->jumlah_masuk;
        $produk->save();

        return redirect()->route('backend.masuk.index')->with('success' , 'Data Berhasil Tersimpan');
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
        
        $produk = Produk::orderBy('id_produk' , 'asc')->get();
        $supplier = Supplier::orderBy('kode_supplier' , 'asc')->get();
        $user = User::orderBy('id_admin' , 'asc')->get();
        $masuk = BarangMasuk::find($id);
        return view('backend.v_masuk.edit' , [
            'judul' => 'Edit Barang Masuk' ,
            'edit' => $masuk,
            'produk' => $produk,
            'supplier' => $supplier,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $masuk = BarangMasuk::findOrFail($id);
        $rules = [
            'id_produk' => 'required',
            'kode_supplier' => 'required',
            'id_admin' => 'required',
            'jumlah_masuk' => 'required',
            'harga_beli' => 'required',
            'tanggal_masuk' => 'required'
        ];

        $validateData = $request->validate($rules);

        $jumlah_lama = $masuk->jumlah_masuk;

        // Hitung total
        $validateData['total_masuk'] = $request->jumlah_masuk * $request->harga_beli;

        // Update
        BarangMasuk::where('id', $id)->update($validateData);

        $produk = Produk::find($request->id_produk);
        $produk->stok = $produk->stok - $jumlah_lama + $request->jumlah_masuk;
        $produk->save();

        return redirect()->route('backend.masuk.index')->with('success' , 'Data Berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $masuk = BarangMasuk::findOrFail($id);
        $produk = Produk::find($masuk->id_produk);
        $produk->stok -= $masuk->jumlah_masuk;
        $produk->stok = max(0, $produk->stok - $masuk->jumlah_masuk);
        $produk->save();
        $masuk->delete();
        return redirect()->route('backend.masuk.index')->with('success' , 'Data berhasil dihapus');
    }
}
