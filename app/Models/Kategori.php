<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public $timestamps = false;
    protected $table = "kategori";
    protected $fillable = [
        'kode' ,
        'nama_kategori',
    ];
    protected $primaryKey = 'kode'; // sesuaikan dengan nama kolom PK kamu
    public $incrementing = false;   // karena string bukan auto increment
    protected $keyType = 'string'; 

    public function produk()
    {
        return $this->hasMany(Produk::class, 'kode', 'kode');
    }
}
