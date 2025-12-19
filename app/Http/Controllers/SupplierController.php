<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::orderBy('kode_supplier' , 'asc')->get();
        return view('backend.v_supplier.index' , [
            'judul' => 'Data Supplier Beauty Care',
            'index' => $supplier
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_supplier.create' , [
            'judul' => 'Tambah data supplier',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode_supplier' => 'required|max:10|unique:supplier',
            'nama_supplier' => 'required|max:100',
            'no_hp' => 'required|max:15',
            'alamat' => 'required',
        ]);
        Supplier::create($validateData);
        return redirect()->route('backend.supplier.index')->with('success' , 'Data Berhasil Tersimpan');
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
        $supplier = Supplier::find($id);
        return view('backend.v_supplier.edit' , [
            'judul' => 'Edit data Supplier' ,
            'edit' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'kode_supplier' => 'required|max:10|',
            'nama_supplier' => 'required|',
            'no_hp' => 'required|max:15',
            'alamat' => 'required'
        ];

        $validateData = $request->validate($rules);
        Supplier::where('kode_supplier' , $id)->update($validateData);
        return redirect()->route('backend.supplier.index')->with('success' , 'Data Berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('backend.supplier.index')->with('success' , 'Data berhasil dihapus');
    }
}
