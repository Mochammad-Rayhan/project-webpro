<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Produk;
use App\Models\User;

class BarangkeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keluar = BarangKeluar::orderBy('updated_at' , 'desc')->get();
        return view('backend.v_keluar.index' , [
            'judul' => "Data Barang keluar Beauty Care",
            'index' => $keluar
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $produk = Produk::orderBy('id_produk' , 'asc')->get();
        $produk = Produk::where('stok', '>', 0)
        ->orderBy('id_produk', 'asc')
        ->get();
        $user = User::orderBy('id_admin' , 'asc')->get();
        return view('backend.v_keluar.create' , [
            'judul' => 'Tambah Barang Keluar',
            'produk' => $produk,
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
            'id_admin' => 'required',
            'jumlah_keluar' => 'required',
            'harga_jual' => 'required',
            'tanggal_keluar' => 'required',
            'keterangan' => 'required',
        ]);


        //Cek bagian produk masuk berdasarkan tanggal
        $barangMasuk = BarangMasuk::where('id_produk', $request->id_produk)
        ->orderBy('tanggal_masuk', 'asc')
        ->first();

        if (!$barangMasuk) {
            return back()->withErrors([
                'id_produk' => 'Produk ini belum memiliki data barang masuk'
            ])->withInput();
        }

        // VALIDASI TANGGAL
        if ($request->tanggal_keluar < $barangMasuk->tanggal_masuk) {
            return back()->withErrors([
                'tanggal_keluar' => 'Tanggal keluar tidak boleh lebih kecil dari tanggal masuk (' 
                    . $barangMasuk->tanggal_masuk . ')'
            ])->withInput();
        }

        //cek stok barang
        $produk = Produk::findOrFail($request->id_produk);
        if ($produk->stok <= 0) {
            return back()->withErrors([
                'jumlah_keluar' => 'Belum bisa melakukan barang keluar'
            ])->withInput();
        }
        
        if ($request->jumlah_keluar > $produk->stok) {
            return back()->withErrors([
                'jumlah_keluar' => 'Jumlah keluar melebihi stok tersedia'
            ])->withInput();
        }

        $total_keluar = $request->jumlah_keluar * $request->harga_jual;

        BarangKeluar::create([
            'id_produk' => $request->id_produk,
            'id_admin' => $request->id_admin,
            'jumlah_keluar' => $request->jumlah_keluar,
            'harga_jual' => $request->harga_jual,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keterangan' => $request->keterangan,
            'total_keluar' => $total_keluar,
        ]);

        $produk = Produk::find($request->id_produk);
        $produk->stok -= $request->jumlah_keluar;
        // $produk->stok = max(0, $produk->stok - $request->jumlah_keluar); // Anti stok minus
        $produk->save();
        return redirect()->route('backend.keluar.index')->with('success' , 'Data Berhasil Tersimpan');
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
        $user = User::orderBy('id_admin' , 'asc')->get();
        $keluar = BarangKeluar::find($id);
        return view('backend.v_keluar.edit' , [
            'judul' => 'Edit Barang Keluar' ,
            'edit' => $keluar,
            'produk' => $produk,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $keluar = BarangKeluar::findOrFail($id);
        $rules = [
            'id_produk' => 'required',
            'id_admin' => 'required',
            'jumlah_keluar' => 'required',
            'harga_jual' => 'required',
            'tanggal_keluar' => 'required',
            'keterangan' => 'required'
        ];

        $barangMasuk = BarangMasuk::where('id_produk', $request->id_produk)
            ->orderBy('tanggal_masuk', 'asc')
            ->first();

        if ($request->tanggal_keluar < $barangMasuk->tanggal_masuk) {
            return back()->withErrors([
                'tanggal_keluar' => 'Tanggal keluar tidak boleh lebih kecil dari tanggal masuk'
            ])->withInput();
        }

        $validateData = $request->validate($rules);

        // Hitung total
        $validateData['total_keluar'] = $request->jumlah_keluar * $request->harga_jual;

        // Update
        BarangKeluar::where('id', $id)->update($validateData);

        $produk = Produk::find($keluar->id_produk);
        $produk->stok += $keluar->jumlah_keluar;
        $keluar->update($request->all());
        $produk->stok -= $request->jumlah_keluar;
        $produk->save();

        return redirect()->route('backend.keluar.index')->with('success' , 'Data Berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $keluar = BarangKeluar::findOrFail($id);
        $produk = Produk::find($keluar->id_produk);
        $produk->stok += $keluar->jumlah_keluar;
        $produk->save();
        $keluar->delete();
        return redirect()->route('backend.keluar.index')->with('success' , 'Data berhasil dihapus');
    }
}
