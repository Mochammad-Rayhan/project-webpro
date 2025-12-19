<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    public $timestamps = true;
    protected $table = 'barangkeluar';
    protected $guarded = ['id'];

    public function produk()
    {
        return $this->belongsTo(Produk::class , 'id_produk' , 'id_produk');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'id_admin' , 'id_admin');
    }
}
