<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public $timestamps = false;
    protected $table = "supplier";
    protected $fillable = [
        'kode_supplier',
        'nama_supplier',
        'no_hp',
        'alamat',
    ];
    protected $primaryKey = 'kode_supplier'; // sesuaikan dengan nama kolom PK kamu
    public $incrementing = false;   // karena string bukan auto increment
    protected $keyType = 'string';


    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_supplier', 'id');
    }

}
