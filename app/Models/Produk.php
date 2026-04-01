<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public $timestamps = true;
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $guarded = ['id'];
    protected $keyType = 'int';
    protected $fillable = [
        'kode',
        'nama_produk',
        'harga_satuan',
        'stok',
        'tanggal_masuk',
        'kadaluarsa',
        'image',
        'description'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kode', 'kode');
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_produk', 'id_produk');
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'id_produk', 'id_produk');
    }

}
