<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Administrator' ,
            'email' => 'admin@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '089518998589' ,
            'password' => bcrypt('admin'),
        ]);
        User::create([
            'nama' => 'Mochammad Rayhan' ,
            'email' => 'rayhan@gmail.com',
            'role' => '0',
            'status' => 1,
            'hp' => '085718678893' ,
            'password' => bcrypt('rayhan'),
        ]);
        User::create([
            'nama' => 'Kamila Zulfa Indika' ,
            'email' => 'kamila@gmail.com',
            'role' => '0',
            'status' => 1,
            'hp' => '085718670000' ,
            'password' => bcrypt('kamila'),
        ]);
        Kategori::create([
            'kode' => 'BC',
            'nama_kategori' => 'Body Care',
        ]);
        Kategori::create([
            'kode' => 'FW',
            'nama_kategori' => 'Face Wash',
        ]);
        Produk::create([
            'kode' => 'FW',
            'nama_produk' => 'Kahf | Skin Energizing & Brightening ',
            'stok' => 20,
            'tanggal_masuk' => '2025-11-11',
            'kadaluarsa' => '2028-10-08,'
        ]);
        Produk::create([
            'kode' => 'FW',
            'nama_produk' => 'Garnier | Bright Complete ',
            'stok' => 10,
            'tanggal_masuk' => '2025-11-1',
            'kadaluarsa' => '2030-09-10,'
        ]);
        Supplier::create([
            'kode_supplier' => 'BS' ,
            'nama_supplier' => 'Berkah Sumberindo',
            'no_hp' => '083822449911' ,
            'alamat' => 'Jl. Melati No.34 , Kota Semarang',
        ]);
        Supplier::create([
            'kode_supplier' => 'AR' ,
            'nama_supplier' => 'Andalas Raya Distribusi',
            'no_hp' => '083822449900' ,
            'alamat' => 'Jl. Pahlawan No.60 , Kota Bandung',
        ]);
        BarangMasuk::create([
            'id_produk' => 1,
            'kode_supplier' => 'AR',
            'id_admin' => 1,
            'jumlah_masuk' => 20,
            'harga_beli' => 5000,
            'total_masuk' => 100000,
            'tanggal_masuk' => '2025-10-10'
        ]);
        BarangKeluar::create([
            'id_produk' => 1,
            'id_admin' => 1,
            'jumlah_keluar' => 5,
            'harga_jual' => 10000,
            'total_keluar' => 50000,
            'tanggal_keluar' => '2025-11-25',
            'keterangan' => 'dibeli oleh customer'
        ]);
    }
}
